<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DecksController extends Controller
{
    public function decks() {
        return view('decks.decks');
    }
}
