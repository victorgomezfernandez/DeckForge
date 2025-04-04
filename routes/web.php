<?php

use App\Http\Controllers\CardsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DecksController;

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('decks', [DecksController::class, 'decks'])->name('decks');

Route::get('sets', [CardsController::class, 'sets'])->name('sets');

Route::get('/search-sets', [CardsController::class, 'searchSets'])->name('search-sets');
Route::get('/search-cards', [CardsController::class, 'searchCards'])->name('search-cards');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
