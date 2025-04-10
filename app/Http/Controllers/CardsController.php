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

    public function addCardToDeck(Request $request)
    {
        $validated = $request->validate([
            'deck_id' => 'required|exists:decks,id',
            'card' => 'required|array',
        ]);

        $deck = Deck::with('colors')->find($validated['deck_id']);
        
        if (!$deck) {
            return response()->json(['error' => 'Deck not found.'], 404);
        }

        $card = Card::find($validated['card']['id']);

        if (!$card) {
            return response()->json(['error' => 'Card not found.'], 404);
        }

        $cardColorIds = $card->colors->pluck('id')->toArray();
        $deckColorIds = $deck->colors->pluck('id')->toArray();

        $newColorIds = array_diff($cardColorIds, $deckColorIds);

        if (!empty($newColorIds)) {
            $deck->colors()->attach($newColorIds);
        }

        $deck->cards()->attach($card);
        return response()->json(['message' => 'Card added to deck successfully.']);
    }
}
