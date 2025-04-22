@extends('layouts.app')
@section('content')
    <div class="container">
        <x-search-bar />
        <h3 class="mb-3"><b>{{ __('decks.your_decks') }}</b></h3>
        <x-decks-list :decks="$decks->items()" />
        <div class="d-flex justify-content-center mt-4">
            {{ $decks->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection