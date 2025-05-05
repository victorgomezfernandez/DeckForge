@extends('layouts.app')
@section('content')
    <div class="container">
        <x-search-bar />
        @if (auth()->user()->subscription('prod_SE108n2SgYwi6u'))
            <h3 class="mb-3"><b>{{ __('decks.your_decks') }}</b></h3>
        @else
            <h3 class="mb-3"><b>{{ __('decks.your_decks') }}: </b>{{ 12 - auth()->user()->decks()->count() }} mazos
                restantes en la versión gratuita</h3>
        @endif
        @if (auth()->user()->decks()->count() > 0)
            <x-decks-list :decks="$decks->items()" />
            <div class="d-flex justify-content-center mt-4">
                {{ $decks->links('pagination::bootstrap-5') }}
            </div>
        @else
            <ul class="no-decks">
                Crea un nuevo mazo aquí:
                <x-deck-create-modal />
            </ul>
        @endif
    </div>
@endsection
