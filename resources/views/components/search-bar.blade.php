@props(['sets' => collect()])
<div class="d-flex align-items-center gap-3 mb-3" style="width: fit-content;">
    <label for="search"><b>{{ __('search_bar.search') }}</b></label>
    <form class="d-flex align-items-center" method="GET" id="searchForm">
        <input type="search" name="query" class="form-control search-input" aria-label="Search" />
        <button class="btn search-button" type="submit">
            <img src="{{ asset('images/search.svg') }}" alt="search" />
        </button>

        @if (request()->is('decks*') || request()->is('your-decks*'))
            <input type="hidden" name="type" id="selectedType" value="Decks" />
        @else
            <select class="form-select ms-2 type-select" name="type" id="selectedType">
                @if (request()->is('cards*'))
                    <option value="Cards">{{ __('search_bar.cards') }}</option>
                    <option value="Sets">{{ __('search_bar.sets') }}</option>
                @else
                    <option value="Cards">{{ __('search_bar.cards') }}</option>
                    <option value="Sets">{{ __('search_bar.sets') }}</option>
                    <option value="Decks">{{ __('search_bar.decks') }}</option>
                @endif
            </select>
        @endif

        @if (!request()->is('home') && !request()->is('your-decks*'))
            <button type="button" class="btn filters-button ml-3" data-bs-toggle="modal"
                data-bs-target="#advancedFilters">{{ __('search_bar.advanced_filters') }} <i
                    class="fa-solid fa-filter"></i></button>
            @if (request()->is('decks*'))
                <x-deck-filters />
            @endif
            @if (request()->is('cards*'))
                <x-card-filters :sets="$sets" />
            @endif
        @endif
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('searchForm');
        const typeSelect = document.getElementById('selectedType');

        const typeToRoute = {
            Cards: '{{ route('search-cards') }}',
            Decks: '{{ route('search-decks') }}',
            Sets: '{{ route('search-sets') }}',
        };

        typeSelect.addEventListener('change', function () {
            const selectedType = typeSelect.value;
            form.action = typeToRoute[selectedType] || '{{ route('search-cards') }}';
        });

        const selectedType = typeSelect.value;
        form.action = typeToRoute[selectedType] || '{{ route('search-cards') }}';
    });
</script>

