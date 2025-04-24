@props(['sets' => collect()])
<div class="modal fade" id="advancedFilters" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content advanced-filters-modal">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('cards.advanced_filters') }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" id="filtersClose"></button>
            </div>

            <div class="modal-body">
                <div class="modal-field">
                    <label for="card_name" class="modal-form-label">{{ __('cards.name') }}</label>
                    <input type="text" class="modal-input form-control" name="card_name" value="{{ request('card_name') }}">
                </div>
                <div class="modal-field">
                    <label for="card_types" class="modal-form-label">{{ __('cards.types') }}</label>
                    <input type="text" class="modal-input form-control" name="card_types" value="{{ request('card_types') }}">
                </div>
                <div class="modal-field">
                    <label for="card_power" class="modal-form-label">{{ __('cards.power') }}</label>
                    <input type="number" class="modal-input form-control" name="card_power" value="{{ request('card_power') }}">
                </div>
                <div class="modal-field">
                    <label for="card_toughness" class="modal-form-label">{{ __('cards.toughness') }}</label>
                    <input type="number" class="modal-input form-control" name="card_toughness" value="{{ request('card_toughness') }}">
                </div>
                <div class="modal-field">
                    <label for="card_value" class="modal-form-label">{{ __('cards.mana_value') }}</label>
                    <input type="number" class="modal-input form-control" name="card_value" value="{{ request('card_value') }}">
                </div>
                <div class="modal-field">
                    <label for="card_lang" class="modal-form-label">{{ __('cards.lang') }}</label>
                    <select class="modal-input form-select" name="card_lang">
                        <option value="">{{ __('cards.any_lang')}}</option>
                        <option value="en" @selected(request('card_lang') === 'en')>{{ __('cards.en') }}</option>
                        <option value="es" @selected(request('card_lang') === 'es')>{{ __('cards.es') }}</option>
                    </select>
                </div>
                <div class="modal-field">
                    <label for="card_set" class="modal-form-label">{{ __('cards.set') }}</label>
                    <select class="modal-input form-select" name="card_set">
                        <option value="">{{ __('cards.any') }}</option>
                        @foreach ($sets as $set)
                            <option value="{{ $set->code }}" @selected(request('card_set') === $set->code)>
                                {{ $set->name }} - {{ strtoupper($set->code) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-field">
                    <label for="deck_colors" class="modal-form-label">{{ __('cards.colors') }}</label>
                    <div class="form-colors">
                        @php $selectedColors = request('colors', []) @endphp
                        <input class="form-check-input modal-form-checkbox" type="checkbox" id="whiteCheck"
                            name="colors[]" value="W" @checked(in_array('W', $selectedColors))>
                        <label class="form-check-label"><img src="{{ asset('images/costs/W.svg') }}" class="form-color-img"></label>

                        <input class="form-check-input modal-form-checkbox" type="checkbox" id="blueCheck"
                            name="colors[]" value="U" @checked(in_array('U', $selectedColors))>
                        <label class="form-check-label"><img src="{{ asset('images/costs/U.svg') }}" class="form-color-img"></label>

                        <input class="form-check-input modal-form-checkbox" type="checkbox" id="blackCheck"
                            name="colors[]" value="B" @checked(in_array('B', $selectedColors))>
                        <label class="form-check-label"><img src="{{ asset('images/costs/B.svg') }}" class="form-color-img"></label>

                        <input class="form-check-input modal-form-checkbox" type="checkbox" id="redCheck"
                            name="colors[]" value="R" @checked(in_array('R', $selectedColors))>
                        <label class="form-check-label"><img src="{{ asset('images/costs/R.svg') }}" class="form-color-img"></label>

                        <input class="form-check-input modal-form-checkbox" type="checkbox" id="greenCheck"
                            name="colors[]" value="G" @checked(in_array('G', $selectedColors))>
                        <label class="form-check-label"><img src="{{ asset('images/costs/G.svg') }}" class="form-color-img"></label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="resetCardFilters" type="button" class="btn modal-reset">{{ __('cards.reset_filters') }}</button>
                <button type="submit" class="btn modal-search" data-bs-dismiss="modal">{{ __('cards.search') }}</button>
            </div>
        </div>
    </div>
</div>
@if (request()->hasAny(['query', 'card_name', 'card_types', 'set', 'colors']))
    <div class="filters-applied">
        @if (request('card_name'))
            <div class="filter-applied">
                {{ __('cards.name') }}: {{ request('card_name') }}
            </div>
        @endif
        @if (request('card_types'))
            <div class="filter-applied">
                {{ __('cards.types') }}: {{ request('card_types') }}
            </div>
        @endif
        @if (request('card_power') && request('card_toughness'))
            <div class="filter-applied">
                {{ __('cards.stats') }}: {{ request('card_power') }}/{{ request('card_toughness') }}
            </div>
        @else
            @if (request('card_power'))
                <div class="filter-applied">
                    {{ __('cards.power') }}: {{ request('card_power') }}
                </div>
            @endif
            @if (request('card_toughness'))
                <div class="filter-applied">
                    {{ __('cards.toughness') }}: {{ request('card_toughness') }}
                </div>
            @endif
        @endif

        @if (request('card_value'))
            <div class="filter-applied">
                {{ __('cards.mana_value') }}: {{ request('card_value') }}
            </div>
        @endif
        @if (request('card_lang'))
        <div class="filter-applied">
            {{ __('cards.lang') }}: {{ request('card_lang') }}
        </div>
        @endif
        @if (request('card_set'))
            <div class="filter-applied">
                {{ __('cards.set') }}: {{ strtoupper(request('card_set')) }}
            </div>
        @endif
        @if (request('colors'))
            <div class="filter-applied">
                {{ __('cards.colors') }}:
                @foreach (request('colors', []) as $color)
                    <img src={{ asset("images/costs/{$color}.svg") }} alt="" class="filter-applied-color">
                @endforeach
            </div>
        @endif
    </div>
@endif
