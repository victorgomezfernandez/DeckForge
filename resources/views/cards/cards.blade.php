
@extends('layouts.app')

@section('content')
    <div class="container">
        <x-search-bar :sets="$sets"/>

        @isset($set)
            <div class="d-flex align-items-center justify-items-center gap-3 mb-4">
                <img src="{{ $set->symbol }}" alt="{{ $set->code }}" style="width: 45px; height: 45px;" />
                <div>
                    <h4 class="mb-0"><b>{{ $set->name }}</b></h4>
                    <small class="text-muted">{{ strtoupper($set->code) }} - {{ $cards->total() }} {{ __('cards.cards') }}</small>
                </div>
            </div>
        @else
            <h3 class="mb-3"><b>{{ __('cards.explore_cards') }}</b></h3>
        @endisset

        <div class="row g-2">
            @foreach ($cards as $card)
                <x-card-card :card="$card" />
            @endforeach
            <div class="d-flex justify-content-center mt-4">
                {{ $cards->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
