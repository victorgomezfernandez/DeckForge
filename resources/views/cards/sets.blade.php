@extends('layouts.app')

@section('content')

<div class="container">
    <x-search-bar />
    <h3 class="mb-3"><b>EXPLORE CARDS BY SET</b></h3>
    <div class="row g-4">
        @foreach ($sets as $set)
        <div class="col-12 col-sm-6 col-md-4 col-lg-2">
            <a href="{{ route('set-cards', ['code' => $set->code]) }}" class="text-decoration-none">
                <div class="set-card">
                    <img src="{{ $set->symbol }}" alt="{{ $set->code }}" class="img-fluid" />
                    <p class="set-title" data-release-date="{{ $set->release_date }}">
                        {{ __($set->name) }}
                    </p>
                    <p class="set-info">{{ strtoupper($set->code) }} - {{ __($set->cards_count) }} cards</p>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection