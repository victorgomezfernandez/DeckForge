@props(['sets' => collect()])
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
            <button class="btn dropdown-toggle search-dropdown" type="button" id="dropdownMenu"
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
            <button type="button" class="btn filters-button ml-3" data-bs-toggle="modal"
                data-bs-target="#advancedFilters">Advanced Filters <i class="fa-solid fa-filter"></i></button>
            @if (request()->is('decks*'))
                <x-deck-filters />
            @endif
            @if (request()->is('cards*'))
                <x-card-filters :sets="$sets"/>
            @endif
        @endif
    </form>
</div>
