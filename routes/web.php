<?php

use App\Http\Controllers\CardsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DecksController;

// Route::get('/', function () {
//     return view('home');
// });

// Route::get('/home', function () {
//     return view('home');
// });

Route::get('/', [DecksController::class, 'recentContent'])->name('home');
Route::get('/home', [DecksController::class, 'recentContent'])->name('home');
Route::get('/decks', [DecksController::class, 'publicDecks'])->name('decks');
Route::post('/decks', [DecksController::class, 'store'])->name('decks.store')->middleware('auth');
Route::get('/decks/deck-details/{id}', [DecksController::class, 'deckDetails'])->name('deck-details');
Route::post('/decks/deck-details/{id}/add-card', [CardsController::class, 'addCardToDeck']);
Route::put('/decks/{deck}/update-thumbnail', [DecksController::class, 'updateDeckThumbnail']);
Route::put('/decks/{deck}/update-field', [DecksController::class, 'updateField'])->middleware('auth');
Route::delete('/decks/{deck}', [DecksController::class, 'destroy'])->middleware('auth');
Route::delete('/decks/{deck}/remove-card/{cardDeckId}', [DecksController::class, 'removeCardFromDeck']);
Route::get('/decks/deck-details/{id}/cards-html', [DecksController::class, 'getDeckCards']);
Route::get('/your-decks', [DecksController::class, 'yourDecks'])->name('your-decks')->middleware('auth');
Route::get('/your-decks/search-decks', [DecksController::class, 'searchYourDecks'])->name('your-decks.search')->middleware('auth');
Route::get('/decks/search-decks', [DecksController::class, 'searchDecks'])->name('search-decks');

Route::get('/cards/sets', [CardsController::class, 'sets'])->name('sets');

Route::get('/cards/sets/search-sets', [CardsController::class, 'searchSets'])->name('search-sets');
Route::get('/cards/search-cards', [CardsController::class, 'searchCards'])->name('search-cards');
Route::get('/cards/sets/{code}/cards', [CardsController::class, 'setCards'])->name('set-cards');
Route::get('/cards/live-search', [CardsController::class, 'liveSearch'])->name('cards.live-search');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
