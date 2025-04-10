@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="container">
            <x-decks-list :decks="$decks" />
        </div>
    </div>
@endsection