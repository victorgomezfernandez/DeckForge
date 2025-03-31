<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CardsController extends Controller
{
    public function cards(){
        return view('cards.cards');
    }
}
