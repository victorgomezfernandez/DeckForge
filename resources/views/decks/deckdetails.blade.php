@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="deck-details col-lg-6">
                <div class="deck-details-header">
                    <span class="deck-details-name">
                        {{ $deck->name }}
                    </span>
                    <div class="deck-details-colors">
                        @foreach ($deck->colors as $color)
                            <img src="{{ asset("images/costs/{$color->code}.svg") }}">
                        @endforeach
                    </div>
                    <div class="deck-details-tag">
                        <span>Format: {{ Str::ucfirst($deck->format->name) }}</span>
                    </div>
                    <div class="deck-details-tag">
                        <span>Card count: </span>
                        <span id="deck-details-count">
                            {{ count($deck->cards) }}
                        </span>
                    </div>
                </div>
                <span class="deck-details-description">{{ $deck->description }}</span>
                <span class="deck-details-description">By {{ $deck->user->name }}</span>
            </div>
            @if (auth()->check() && auth()->user()->id === $deck->user_id)
                <div class="col-lg-6 d-flex flex-column align-items-end">
                    <div class="d-flex align-items-center justify-content-end gap-2 mb-2"
                        style="width: 100%; max-width: 300px;">
                        <label for="card-live-search" class="mb-0"><b>Add Cards</b></label>
                        <input type="search" id="card-live-search" class="form-control live-search-input" />
                    </div>

                    <div class="position-relative" style="width: 100%; max-width: 300px;">
                        <ul id="card-results" class="list-group position-absolute live-search-results">
                        </ul>
                    </div>
                </div>
            @endif
        </div>
        <div id="deck-card-list">
            @include('components.deck-details-cards', ['deck' => $deck])
        </div>
        <input type="hidden" id="deck-id" value="{{ $deck->id }}">
        <input type="hidden" id="user-id" value="{{ auth()->check() ? auth()->user()->id : '' }}">
        <input type="hidden" id="creator-id" value="{{ auth()->check() && auth()->user()->id === $deck->user_id ? $deck->user->id : '' }}">
    @endsection
