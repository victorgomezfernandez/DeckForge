<?php

use App\Http\Controllers\CardsController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DecksController;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Middleware\EnsureSubscribedUser;

// Route::get('/', function () {
//     return view('home');
// });

// Route::get('/home', function () {
//     return view('home');
// });

Route::get('/', [DecksController::class, 'recentContent'])->name('home');
Route::get('/google-auth/redirect', function () {

    return Socialite::driver('google')->redirect();

});

Route::get('/google-auth/callback', function () {

    $user_google = Socialite::driver('google')->user();

    $user = User::updateOrCreate([
        'google_id' => $user_google->id,
    ], [
        'name' => $user_google->name,
        'email' => $user_google->email,
    ]);

    Auth::login($user);

    return redirect('/home');

});

Route::get('/github-auth/redirect', function () {

    return Socialite::driver('github')->redirect();

});

Route::get('/github-auth/callback', function () {

    $user_github = Socialite::driver('github')->user();

    $user = User::updateOrCreate([
        'github_id' => $user_github->id,
    ], [
        'name' => $user_github->name ?? $user_github->nickname ?? 'GitHubUser',
        'email' => $user_github->email,
    ]);

    Auth::login($user);

    return redirect('/home');

});

Route::get('/facebook-auth/redirect', function () {

    return Socialite::driver('facebook')->redirect();

});

Route::get('/facebook-auth/callback', function () {

    $user_facebook = Socialite::driver('facebook')->user();

    $user = User::updateOrCreate([
        'facebook_id' => $user_facebook->id,
    ], [
        'name' => $user_facebook->name ?? $user_facebook->nickname ?? 'FacebookUser',
        'email' => $user_facebook->email,
    ]);

    Auth::login($user);

    return redirect('/home');

});

Route::get('/pricing', function(){
    return view('subscription.pricing');
})->name('pricing')->middleware('auth');

Route::get('checkout/{plan?}', CheckoutController::class)->name('checkout')->middleware('auth');

Route::get('/success', function(){
    return view('subscription.success');
})->name('success')->middleware(['auth', EnsureSubscribedUser::class]);

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

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
