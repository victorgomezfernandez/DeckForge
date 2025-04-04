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

    <main class="py-4">
        @yield('results')
    </main>
</div>