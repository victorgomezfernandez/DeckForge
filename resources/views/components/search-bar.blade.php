<div class="d-flex align-items-center gap-3 mb-3" style="width: fit-content;">
    <label for="search"><b>Search</b></label>
    <form class="d-flex align-items-center" method="GET" id="searchForm">
        <input type="search" name="query" class="form-control search-input" aria-label="Search" />
        <button class="btn search-button" type="submit">
            <img src="{{ asset('images/search.svg') }}" alt="search" />
        </button>

        @if (request()->is('decks*') || request()->is('your-decks*'))
            <input type="hidden" name="type" id="selectedType" value="Decks" />
        @else
            <button class="btn dropdown-toggle search-dropdown m-3" type="button" id="dropdownMenu"
                data-bs-toggle="dropdown" aria-expanded="false">
                Cards
            </button>
            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenu">
                @if (request()->is('cards*'))
                    <li><a class="dropdown-item" data-value="Cards">Cards</a></li>
                    <li><a class="dropdown-item" data-value="Sets">Sets</a></li>
                @else
                    <li><a class="dropdown-item" data-value="Cards">Cards</a></li>
                    <li><a class="dropdown-item" data-value="Sets">Sets</a></li>
                    <li><a class="dropdown-item" data-value="Decks">Decks</a></li>
                @endif
            </ul>
            <input type="hidden" name="type" id="selectedType" value="Cards" />
        @endif

        @if (!request()->is('home'))
            <button type="button" class="btn filters-button m-3" data-bs-toggle="modal"
                data-bs-target="#advancedFilters">Advanced Filters <i class="fa-solid fa-filter"></i></button>
            <div class="modal fade" id="advancedFilters" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content advanced-filters-modal">
                        <div class="modal-header">
                            <h4 class="modal-title">Advanced Filters</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" id="filtersClose"></button>
                        </div>

                        @if (request()->is('decks*'))
                            <div class="modal-body">
                                <div class="modal-field">
                                    <label for="deck_name" class="modal-form-label">Deck Name</label>
                                    <input type="text" class="modal-input form-control" name="deck_name">
                                </div>
                                <div class="modal-field">
                                    <label for="deck_format" class="modal-form-label">Format</label>
                                    <select class="modal-input form-select" name="deck_format">
                                        <option value="">Any</option>
                                        <option value="Standard">Standard</option>
                                        <option value="Vintage">Vintage</option>
                                    </select>
                                </div>
                                <div class="modal-field">
                                    <label for="deck_creator" class="modal-form-label">Creator</label>
                                    <input type="text" class="modal-input form-control" name="deck_creator">
                                </div>
                                <div class="modal-field">
                                    <label for="deck_colors" class="modal-form-label">Colors</label>
                                    <div class="form-colors">
                                        <input class="form-check-input modal-form-checkbox" type="checkbox"
                                            id="whiteCheck" name="whiteCheck" value="white">
                                        <label class="form-check-label"><img src="{{ asset('images/costs/W.svg') }}"
                                                class="form-color-img"></label>
                                        <input class="form-check-input modal-form-checkbox" type="checkbox"
                                            id="blueCheck" name="blueCheck" value="blue">
                                        <label class="form-check-label"><img src="{{ asset('images/costs/U.svg') }}"
                                                class="form-color-img"></label>
                                        <input class="form-check-input modal-form-checkbox" type="checkbox"
                                            id="blackCheck" name="blackCheck" value="black">
                                        <label class="form-check-label"><img src="{{ asset('images/costs/B.svg') }}"
                                                class="form-color-img"></label>
                                        <input class="form-check-input modal-form-checkbox" type="checkbox"
                                            id="redCheck" name="redCheck" value="red">
                                        <label class="form-check-label"><img src="{{ asset('images/costs/R.svg') }}"
                                                class="form-color-img"></label>
                                        <input class="form-check-input modal-form-checkbox" type="checkbox"
                                            id="greenCheck" name="greenCheck" value="green">
                                        <label class="form-check-label"><img src="{{ asset('images/costs/G.svg') }}"
                                                class="form-color-img"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button id="resetAdvancedFilters" type="button" class="btn modal-reset">Reset
                                    Filters</button>
                                <button type="submit" class="btn modal-search"
                                    data-bs-dismiss="modal">Search</button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
