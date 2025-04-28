<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Deck;
use App\Models\Format;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $decks = Deck::where('user_id', $user_id)->orderBy('created_at', 'desc')->paginate(24);
        return view('decks.yourdecks', compact('decks'));
    }

    public function deckDetails($id)
    {
        $deck = Deck::find($id);
        return view('decks.deckdetails', compact('deck'));
    }

    public function getDeckCards($id)
    {
        $deck = Deck::findOrFail($id);
        return view('components.deck-details-cards', compact('deck'))->render();
    }

    public function getDeckColors($id)
    {
        $deck = Deck::findOrFail($id);
        return view('components.deck-details-colors', compact('deck'))->render();
    }

    public function publicDecks()
    {
        $decks = Deck::where('public', TRUE)->orderByDesc('created_at')->paginate(24);
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

    public function removeCardFromDeck(Request $request, Deck $deck, $cardDeckId)
    {
        $cardDeck = DB::table('cards_deck')->where('id', $cardDeckId)->first();

        $card = Card::find($cardDeck->card_id);

        $cardColors = $card->colors;

        DB::table('cards_deck')->where('id', $cardDeckId)->delete();

        $remainingCardIds = DB::table('cards_deck')->where('deck_id', $deck->id)->pluck('card_id');

        $remainingColorIds = DB::table('cards')
            ->join('card_colors', 'cards.id', '=', 'card_colors.card_id')
            ->whereIn('cards.id', $remainingCardIds)
            ->pluck('card_colors.color_id')
            ->unique()
            ->toArray();

        foreach ($cardColors as $cardColor) {
            if (!in_array($cardColor->id, $remainingColorIds)) {
                $deck->colors()->detach($cardColor->id);
            }
        }

        return response()->json(['success' => true]);
    }

    public function updateField(Request $request, Deck $deck)
    {

        $validated = $request->validate([
            'field' => 'required|string|in:name,description',
            'value' => 'required|string|max:255',
        ]);

        $deck->{$validated['field']} = $validated['value'];
        $deck->save();

        return response()->json(['success' => true]);
    }

    // public function searchDecks(Request $request)
    // {
    //     $query = $request->input('query');

    //     $decks = Deck::where('public', true)
    //         ->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($query) . '%'])
    //         ->paginate(24);

    //     return view('decks.decks', compact('decks'));
    // }

    public function recentContent()
    {
        $decks = Deck::where('public', true)->latest()->take(6)->get();
        $cards = Card::latest()->take(6)->get();
        $userDecks = null;
        if (Auth::check()) {
            $userDecks = Deck::where('user_id', Auth::id())->latest()->take(6)->get();
            if ($userDecks->isEmpty()) {
                $userDecks = null;
            }
        }

        return view('home', compact('decks', 'cards', 'userDecks'));
    }

    public function searchYourDecks(Request $request)
    {
        $query = $request->input('query');
        $user_id = Auth::id();

        $decks = Deck::where('user_id', $user_id)
            ->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($query) . '%'])
            ->orderByDesc('created_at')
            ->paginate(24);

        return view('decks.yourdecks', compact('decks'));
    }

    public function filterDecks(Request $request)
    {
        $query = Deck::query();

        if ($request->filled('query')) {
            $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($request->query('query')) . '%']);
        }

        if ($request->filled('deck_name')) {
            $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($request->deck_name) . '%']);
        }

        if ($request->filled('deck_format')) {
            $query->whereHas('format', function ($q) use ($request) {
                $q->whereRaw('name LIKE ?', [strtolower($request->deck_format)]);
            });
        }

        if ($request->filled('deck_creator')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($request->deck_creator) . '%']);
            });
        }

        if ($request->filled('colors')) {
            $colors = $request->input('colors');

            foreach ($colors as $color) {
                $query->whereHas('colors', function ($q) use ($color) {
                    $q->whereRaw('LOWER(code) = ?', [strtolower($color)]);
                });
            }
        }

        $decks = $query->with(['user', 'format'])->paginate(24);

        return view('decks.decks', compact('decks'));
    }


    public function destroy(Deck $deck)
    {
        $deck->delete();

        return response()->json(['success' => true]);
    }
}
