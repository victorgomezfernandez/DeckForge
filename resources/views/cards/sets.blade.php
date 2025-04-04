@extends('layouts.app')

@section('content')
<div class="container">

    <div class="d-flex align-items-center gap-3 mb-3">
        <label for="search"><b>Search</b></label>
        <form class="d-flex align-items-center" action="{{ route('search-sets') }}" method="GET" id="searchForm">
            <input type="search" name="query" class="form-control search-input" aria-label="Search" />
            <button class="btn search-button" type="submit">
                <img src="{{ asset('images/search.svg') }}" alt="search" />
            </button>
            <button class="btn dropdown-toggle search-dropdown m-3" type="button" id="dropdownMenu"
                data-bs-toggle="dropdown" aria-expanded="false">
                Type
            </button>
            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenu">
                <li><a class="dropdown-item" data-value="Sets">Sets</a></li>
                <li><a class="dropdown-item" data-value="Cards">Cards</a></li>
            </ul>

            <input type="hidden" name="type" id="selectedType" value="Sets" />
        </form>
    </div>

    <h3 class="mb-3"><b>EXPLORE CARDS BY SET</b></h3>
    <div class="row g-4">
        @foreach ($sets as $set)
        <div class="col-12 col-sm-6 col-md-4 col-lg-2">
            <div class="set-card">
                <img src="{{ $set->symbol }}" alt="{{ $set->code }}" class="img-fluid" />
                <p class="set-title">{{ __($set->name) }}</p>
                <p class="set-info">{{ __($set->code) }} - {{ __($set->cards_count) }} cards</p>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
    document.querySelectorAll('.dropdown-item').forEach(function (item) {
        item.addEventListener('click', function () {
            var selectedValue = item.getAttribute('data-value');

            document.getElementById('dropdownMenu').textContent = selectedValue;

            document.getElementById('selectedType').value = selectedValue;

            var form = document.getElementById('searchForm');
            if (selectedValue === 'Sets') {
                form.action = '/search-sets';
            } else if (selectedValue === 'Cards') {
                form.action = '/search-cards';
            }
        });
    });
</script>
@endsection