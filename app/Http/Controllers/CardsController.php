<?php

namespace App\Http\Controllers;

use App\Models\Card;
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

    public function searchCards(Request $request)
    {
        $query = $request->input('query');
        // $cards = Card::has('card_details')
        //     ->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($query) . '%'])
        //     ->get();
        return view('cards.cards'/*, compact('cards')*/);
    }
}
