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
Route::post('/decks', [DecksController::class, 'store'])->name('decks.store')->middleware('auth');
Route::get('/decks/deck-details/{id}', [DecksController::class, 'deckDetails'])->name('deck-details');
Route::post('/decks/deck-details/{id}/add-card', [CardsController::class, 'addCardToDeck']);
Route::get('/your-decks', [DecksController::class, 'yourDecks'])->name('your-decks');

Route::get('/cards/sets', [CardsController::class, 'sets'])->name('sets');

Route::get('/cards/sets/search-sets', [CardsController::class, 'searchSets'])->name('search-sets');
Route::get('/cards/search-cards', [CardsController::class, 'searchCards'])->name('search-cards');
Route::get('/cards/sets/{code}/cards', [CardsController::class, 'setCards'])->name('set-cards');
Route::get('/cards/live-search', [CardsController::class, 'liveSearch'])->name('cards.live-search');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
