@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="deck-details col-lg-8">
                <div class="deck-details-info col">
                    @if (auth()->check() && auth()->user()->id === $deck->user_id)
                        <div class="col-lg-4 w-auto">
                            <div class="format-section">
                                <label for="formatSelect" class="format-label">{{ __('decks.format') }}:</label>
                                <select name="deck-format" id="formatSelect" class="deck-details-select form-select">
                                    <option value="vintage" {{ $deck->format->name === 'vintage' ? 'selected' : '' }}>Vintage
                                    </option>
                                    <option value="standard" {{ $deck->format->name === 'standard' ? 'selected' : '' }}>
                                        Standard
                                    </option>
                                </select>
                            </div>
                        </div>
                    @else
                        <div class="deck-details-tag col-lg-4">
                            <span>{{ __('decks.format') }}: {{ Str::ucfirst($deck->format->name) }}</span>
                        </div>
                    @endif
                    <div class="deck-details-tag col-lg-4">
                        <span>{{ __('decks.card_count') }}</span>
                        <span id="deck-details-count">
                            {{ count($deck->cards) }}
                        </span>
                    </div>
                    @if (auth()->check() && auth()->user()->id === $deck->user_id)
                        <button class="btn btn-danger col-lg-4" id="deck-delete">
                            <span>{{ __('decks.delete_deck') }} <i class="fa-solid fa-trash"
                                    style="color: white;"></i></span>
                        </button>
                    @endif
                </div>


            </div>
            @if (auth()->check() && auth()->user()->id === $deck->user_id)
                <div class="col-lg-4 d-flex flex-column align-items-end">
                    <div class="d-flex align-items-center justify-content-end gap-2" style="width: 100%; max-width: 300px;">
                        <label for="card-live-search"
                            class="mb-0 live-search-label"><b>{{ __('decks.add_cards') }}</b></label>
                        <input type="search" id="card-live-search" class="form-control live-search-input" />
                    </div>

                    <div class="position-relative" style="width: 100%; max-width: 300px;">
                        <ul id="card-results" class="list-group position-absolute live-search-results">
                        </ul>
                    </div>
                </div>
            @endif
        </div>
        <div class="row mt-2">
            <div class="deck-details-header">
                <div id="deck-colors">
                    @include('components.deck-details-colors', ['deck' => $deck])
                </div>
                @if (auth()->check() && auth()->user()->id === $deck->user_id)
                    <input type="text" id="deckNameInput" class="deck-details-name deck-details-input"
                        value="{{ $deck->name }}" />
                @else
                    <span class="deck-details-name">{{ $deck->name }}</span>
                @endif
                <span class="deck-details-description">{{ __('decks.by') }}{{ $deck->user->name }}</span>
            </div>
        </div>
        <div class="deck-details-description mt-2">
            @if (auth()->check() && auth()->user()->id === $deck->user_id)
                <input type="text" value="{{ $deck->description }}" class="deck-details-description deck-details-input"
                    placeholder="Deck description" id="deckDescriptionInput">
            @else
                <span class="deck-details-description">{{ $deck->description }}</span>
            @endif
        </div>
        <div id="deck-card-list">
            @include('components.deck-details-cards', ['deck' => $deck])
        </div>
        <input type="hidden" id="deck-id" value="{{ $deck->id }}">
        <input type="hidden" id="user-id" value="{{ auth()->check() ? auth()->user()->id : '' }}">
        <input type="hidden" id="creator-id"
            value="{{ auth()->check() && auth()->user()->id === $deck->user_id ? $deck->user->id : '' }}">
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const nameInput = document.getElementById('deckNameInput');
        const descriptionInput = document.getElementById('deckDescriptionInput');

        function adjustWidth(input) {
            input.style.width = '1px';
            input.style.width = input.scrollWidth + 10 + 'px';
        }

        function enforceMaxLength(input, max) {
            input.addEventListener('input', function() {
                if (input.value.length > max) {
                    input.value = input.value.slice(0, max);
                }
                adjustWidth(input);
            });
        }

        if (nameInput) {
            adjustWidth(nameInput);
            enforceMaxLength(nameInput, 25);
        }

        if (descriptionInput) {
            adjustWidth(descriptionInput);
            enforceMaxLength(descriptionInput, 100);
        }
    });
</script>
