@extends('layouts.app')
@section('content')
    <div class="container">
        <x-search-bar />
        <h3 class="mb-3"><b>YOUR DECKS</b></h3>
        <x-decks-list :decks="$decks" />
    </div>
@endsection