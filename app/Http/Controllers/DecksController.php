<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Deck;
use App\Models\Format;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DecksController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'format' => 'required',
        ]);

        $deck = new Deck();
        $deck->name = $request->name;
        $deck->description = $request->description;
        $deck->format_id = Format::where('name', strtolower($request->format))->first()->id;
        $deck->user_id = Auth::id();
        $deck->public = $request->boolean('public');
        $deck->save();

        return redirect()->route('your-decks')->with('success', 'Deck created successfully!');
    }

    public function decks()
    {
        $decks = Deck::with('user')->get();
        return view('decks.decks', compact('decks'));
    }

    public function yourDecks()
    {
        $user_id = Auth::id();
        $decks = Deck::where('user_id', $user_id)->orderByDesc('created_at')->get();
        return view('decks.yourdecks', compact('decks'));
    }

    public function deckDetails($id)
    {
        $deck = Deck::find($id);
        return view('decks.deckdetails', compact('deck'));
    }

    public function getDeckCards($id)
    {
        $deck = Deck::with(['cards.card_details.types', 'cards.card_details.mana_costs.color', 'format'])->findOrFail($id);
        return view('components.deck-details-cards', compact('deck'))->render();
    }

    public function publicDecks()
    {
        $decks = Deck::where('public', TRUE)->orderByDesc('created_at')->get();
        return view('decks.decks', compact('decks'));
    }

    public function searchDecks(Request $request)
    {
        $query = $request->input('query');
        $decks = Deck::whereHas('name', function ($q) use ($query) {
            $q->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($query) . '%']);
        })->paginate(20);
        return view('decks.decks', compact('decks'));
    }

    public function updateDeckThumbnail(Request $request, Deck $deck)
    {
        $request->validate([
            'art_crop' => 'required|url'
        ]);

        $deck->update([
            'img' => $request->art_crop,
        ]);

        return response()->json(['success' => true]);
    }

    public function removeCardFromDeck(Request $request, Deck $deck, $cardId)
    {
        $card = $deck->cards()->where('card_id', $cardId)->first();
        
        if ($card) {
            $deck->cards()->detach($card);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Carta no encontrada']);
    }
}
