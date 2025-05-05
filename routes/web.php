<?php

use App\Http\Controllers\CardsController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DecksController;
use App\Http\Middleware\EnsureSubscribedUser;
use App\Http\Middleware\EnsureUnsubscribedUser;
use App\Http\Controllers\SocialAuthController;

Route::get('/', [DecksController::class, 'recentContent'])->name('home');

Route::get('/{provider}-auth/redirect', [SocialAuthController::class, 'redirect']);
Route::get('/{provider}-auth/callback', [SocialAuthController::class, 'callback']);


Route::get('/pricing', function(){
    return view('subscription.pricing');
})->name('pricing')->middleware(['auth', EnsureUnsubscribedUser::class]);

Route::get('checkout/{plan?}', CheckoutController::class)->name('checkout')->middleware('auth');

Route::get('/success', function(){
    return view('subscription.success');
})->name('success')->middleware(['auth', EnsureSubscribedUser::class]);

Route::post('/subscription/cancel', function () {
    $user = Auth::user();
    if ($user->subscribed('prod_SE108n2SgYwi6u')) {
        $user->subscription('prod_SE108n2SgYwi6u')->cancel();
    }
    return back()->with('status', 'Suscripción cancelada.');
})->middleware('auth')->name('subscription.cancel');

Route::get('/home', [DecksController::class, 'recentContent'])->name('home');
Route::get('/decks', [DecksController::class, 'publicDecks'])->name('decks');
Route::post('/decks', [DecksController::class, 'store'])->name('decks.store')->middleware('auth');
Route::get('/decks/deck-details/{id}', [DecksController::class, 'deckDetails'])->name('deck-details');
Route::post('/decks/deck-details/{id}/add-card', [DecksController::class, 'addCardToDeck']);
Route::put('/decks/{deck}/update-thumbnail', [DecksController::class, 'updateDeckThumbnail']);
Route::put('/decks/{deck}/update-field', [DecksController::class, 'updateField'])->middleware('auth');
Route::post('/decks/{deck}/update-format', [DecksController::class, 'updateFormat'])->middleware('auth');
Route::delete('/decks/{deck}', [DecksController::class, 'destroy'])->middleware('auth');
Route::delete('/decks/{deck}/remove-card/{cardDeckId}', [DecksController::class, 'removeCardFromDeck']);
Route::get('/decks/deck-details/{id}/cards-html', [DecksController::class, 'getDeckCards']);
Route::get('/decks/deck-details/{id}/colors-html', [DecksController::class, 'getDeckColors']);
Route::get('/your-decks', [DecksController::class, 'yourDecks'])->name('your-decks')->middleware('auth');
Route::get('/your-decks/search-decks', [DecksController::class, 'searchYourDecks'])->name('your-decks.search')->middleware('auth');
Route::get('/decks/search-decks', [DecksController::class, 'filterDecks'])->name('search-decks');

Route::get('/cards/sets', [CardsController::class, 'sets'])->name('sets');

Route::get('/cards/sets/search-sets', [CardsController::class, 'searchSets'])->name('search-sets');
Route::get('/cards/search-cards', [CardsController::class, 'filterCards'])->name('search-cards');
Route::get('/cards/sets/{code}/cards', [CardsController::class, 'setCards'])->name('set-cards');
Route::get('/cards/live-search', [CardsController::class, 'liveSearch'])->name('cards.live-search');

Auth::routes();