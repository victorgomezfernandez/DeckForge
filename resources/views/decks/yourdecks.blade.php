@extends('layouts.app')
@section('content')
    <div class="container">
        <x-decks-list :decks="$decks" />
    </div>
@endsection