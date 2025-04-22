@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="search-bar">
            <x-search-bar />
        </div>
        <div class="home-content">
            @if (isset($userDecks))
                <h3 class="home-section-header">{{ __('home.your_decks') }}</h3>
                <x-decks-list :decks="$userDecks" />
            @endif
            <h3 class="home-section-header">{{ __('home.recent_decks') }}</h3>
            <x-decks-list :decks="$decks" />
            <h3 class="home-section-header">{{ __('home.latest_cards') }}</h3>
            <div class="row">
                @foreach ($cards as $card)
                <x-card-card :card="$card" />
                @endforeach
            </div>
        </div>
    </div>
@endsection
