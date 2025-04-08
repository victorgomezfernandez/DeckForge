<?php

namespace App\Http\Controllers;

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

    public function decks() {
        return view('decks.decks');
    }

    public function yourDecks() {
        $user_id = Auth::id();
        $decks = Deck::where('user_id', $user_id)->get();
        return view('decks.yourdecks', compact('decks'));
    }
}
