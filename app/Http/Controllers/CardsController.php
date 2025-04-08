<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\CardDetails;
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
        $set = Set::where('code', $code)->firstOrFail();

        $cards = Card::where('set_id', $set->id)
            ->with(['card_details', 'card_details.types', 'card_details.mana_costs.color', 'legalities', 'set'])
            ->orderByRaw("
            CASE
                WHEN collector_number ~ '^\d+' THEN CAST(regexp_replace(collector_number, '\\D.*$', '') AS INTEGER)
                ELSE 999999
            END")

            ->paginate(60);

        return view('cards.cards', compact('cards', 'set'));
    }


    public function searchCards(Request $request)
    {
        $query = $request->input('query');

        $cards = Card::whereHas('card_details', function ($q) use ($query) {
            $q->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($query) . '%']);
        })->with(['card_details', 'set'])->paginate(60);

        return view('cards.cards', compact('cards'));
    }
}
