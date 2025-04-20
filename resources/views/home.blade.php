@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="search-bar">
            <x-search-bar />
        </div>
        <div class="home-content">
            @if (isset($userDecks))
                <h3 class="home-section-header">YOUR DECKS</h3>
                <x-decks-list :decks="$userDecks" />
            @endif
            <h3 class="home-section-header">RECENT DECKS</h3>
            <x-decks-list :decks="$decks" />
            <h3 class="home-section-header">LATEST CARDS</h3>
            <div class="row">
                @foreach ($cards as $card)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                        <button type="button" class="card-card btn" data-bs-toggle="modal"
                            data-bs-target="#{{ $card->id }}">
                            <img src="{{ $card->img }}" alt="{{ $card->collector_number }}" class="img-fluid" />
                            <p class="card-text">{{ strtoupper($card->set->code) }} - #{{ $card->collector_number }}</p>
                        </button>
                        <x-card-modal :card="$card" />
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
