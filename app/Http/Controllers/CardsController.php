<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\CardDetails;
use App\Models\Deck;
use App\Models\Set;
use Illuminate\Http\Request;

class CardsController extends Controller
{
    public function sets()
    {
        $sets = Set::has('cards')->withCount('cards')->orderBy('release_date', 'asc')->get();

        return view('cards.sets', compact('sets'));
    }

    public function searchSets(Request $request)
    {
        $query = $request->input('query');
        $sets = Set::has('cards')
            ->withCount('cards')
            ->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($query) . '%'])
            ->orderBy('release_date', 'asc')
            ->get();

        return view('cards.sets', compact('sets'));
    }

    public function setCards($code)
    {
        $sets = Set::has('cards')->withCount('cards')->orderBy('release_date', 'asc')->get();
        
        $set = Set::where('code', $code)->firstOrFail();

        $cards = Card::where('set_id', $set->id)
            ->with(['card_details', 'card_details.types', 'card_details.mana_costs.color', 'legalities', 'set'])
            ->orderByRaw("
            CASE
                WHEN collector_number ~ '^\d+' THEN CAST(regexp_replace(collector_number, '\\D.*$', '') AS INTEGER)
                ELSE 999999
            END")

            ->paginate(60);

        return view('cards.cards', compact('cards', 'set', 'sets'));
    }


    public function searchCards(Request $request)
    {
        $query = $request->input('query');

        $cards = Card::whereHas('card_details', function ($q) use ($query) {
            $q->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($query) . '%']);
        })->with(['card_details', 'set'])->paginate(60);

        return view('cards.cards', compact('cards'));
    }

    public function filterCards(Request $request)
    {

        $sets = Set::whereHas('cards')->orderBy('release_date', 'asc')->get();

        $query = Card::query();

        if ($request->filled('query')) {
            $query->whereHas('card_details', function ($q) use ($request) {
                $q->whereRaw('LOWER (name) LIKE ?', ['%' . strtolower($request->query('query')) . '%']);
            });
        };

        if ($request->filled('card_name')) {
            $query->whereHas('card_details', function ($q) use ($request) {
                $q->whereRaw('LOWER (name) LIKE ?', ['%' . strtolower($request->card_name) . '%']);
            });
        };

        if ($request->filled('card_types')) {
            $types = array_map('trim', explode(' ', $request->card_types));

            foreach ($types as $type) {
                $query->whereHas('card_details', function ($q) use ($type) {
                    $q->whereHas('types', function ($q2) use ($type) {
                        $q2->whereRaw('LOWER(name) = ?', [strtolower($type)]);
                    });
                });
            }
        }


        if ($request->filled('card_power')) {
            $query->whereHas('card_details', function ($q) use ($request) {
                $q->where('power', ($request->card_power));
            });
        };

        if ($request->filled('card_toughness')) {
            $query->whereHas('card_details', function ($q) use ($request) {
                $q->where('toughness', ($request->card_toughness));
            });
        };

        if ($request->filled('card_value')) {
            $query->where('mana_value', ($request->card_value));
        };

        if ($request->filled('card_set')) {
            $query->whereHas('set', function ($q) use ($request) {
                $q->whereRaw('LOWER (code) LIKE ?', ['%' . strtolower($request->card_set) . '%']);
            });
        };

        if ($request->filled('card_lang')) {
            $query->where('lang', ($request->card_lang));
        };

        if ($request->filled('colors')) {
            $colors = $request->input('colors');

            foreach ($colors as $color) {
                $query->whereHas('colors', function ($q) use ($color) {
                    $q->whereRaw('LOWER(code) = ?', [strtolower($color)]);
                });
            }
        };


        $cards = $query->with(['card_details'])->paginate(60);

        return view('cards.cards', compact('cards', 'sets'));
    }

    public function liveSearch(Request $request)
    {
        $query = $request->get('q');

        if (strlen($query) < 3) {
            return response()->json([]);
        }

        $cards = Card::whereHas('card_details', function ($q) use ($query) {
            $q->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($query) . '%']);
        })
            ->with(['card_details', 'set'])
            ->get();

        return response()->json($cards);
    }

    
}
