<div class="modal fade" id="advancedFilters" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content advanced-filters-modal">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('decks.advanced_filters') }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" id="filtersClose"></button>
            </div>

            <div class="modal-body">
                <div class="modal-field">
                    <label for="deck_name" class="modal-form-label">{{ __('decks.deck_name') }}</label>
                    <input type="text" class="modal-input form-control" name="deck_name">
                </div>
                <div class="modal-field">
                    <label for="deck_format" class="modal-form-label">{{ __('decks.format') }}</label>
                    <select class="modal-input form-select" name="deck_format">
                        <option value="">{{ __('decks.any') }}</option>
                        <option value="Standard">Standard</option>
                        <option value="Vintage">Vintage</option>
                    </select>
                </div>
                <div class="modal-field">
                    <label for="deck_creator" class="modal-form-label">{{ __('decks.creator') }}</label>
                    <input type="text" class="modal-input form-control" name="deck_creator">
                </div>
                <div class="modal-field">
                    <label for="deck_colors" class="modal-form-label">{{ __('decks.colors') }}</label>
                    <div class="form-colors">
                        <label class="form-check-label"><img src="{{ asset('images/costs/W.svg') }}"
                                class="form-color-img"></label>
                        <input class="form-check-input modal-form-checkbox" type="checkbox" id="whiteCheck"
                            name="colors[]" value="W">
                            <label class="form-check-label"><img src="{{ asset('images/costs/U.svg') }}"
                                    class="form-color-img"></label>
                        <input class="form-check-input modal-form-checkbox" type="checkbox" id="blueCheck"
                            name="colors[]" value="U">
                            <label class="form-check-label"><img src="{{ asset('images/costs/B.svg') }}"
                                    class="form-color-img"></label>
                        <input class="form-check-input modal-form-checkbox" type="checkbox" id="blackCheck"
                            name="colors[]" value="B">
                            <label class="form-check-label"><img src="{{ asset('images/costs/R.svg') }}"
                                    class="form-color-img"></label>
                        <input class="form-check-input modal-form-checkbox" type="checkbox" id="redCheck"
                            name="colors[]" value="R">
                            <label class="form-check-label"><img src="{{ asset('images/costs/G.svg') }}"
                                    class="form-color-img"></label>
                        <input class="form-check-input modal-form-checkbox" type="checkbox" id="greenCheck"
                            name="colors[]" value="G">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="resetDeckFilters" type="button" class="btn modal-reset">{{ __('decks.reset_filters') }}</button>
                <button type="submit" class="btn modal-search" data-bs-dismiss="modal">{{ __('decks.search') }}</button>
            </div>
        </div>
    </div>
</div>

@if (request()->hasAny(['query', 'deck_name', 'deck_format', 'deck_creator', 'colors']))
    <div class="filters-applied">
        @if (request('deck_format'))
            <div class="filter-applied">
                Format: {{ request('deck_format') }}
            </div>
        @endif
        @if (request('deck_creator'))
            <div class="filter-applied">
                Creator: {{ request('deck_creator') }}
            </div>
        @endif
        @if (request('colors'))
            <div class="filter-applied">
                Colors:
                @foreach (request('colors', []) as $color)
                    <img src={{ asset("images/costs/{$color}.svg") }} alt="" class="filter-applied-color">
                @endforeach
            </div>
        @endif
    </div>
@endif