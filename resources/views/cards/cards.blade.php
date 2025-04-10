
@extends('layouts.app')

@section('content')
    <div class="container">
        <x-search-bar />
        <!-- <x-card-filters /> -->

        @isset($set)
            <div class="d-flex align-items-center justify-items-center gap-3 mb-4">
                <img src="{{ $set->symbol }}" alt="{{ $set->code }}" style="width: 45px; height: 45px;" />
                <div>
                    <h4 class="mb-0"><b>{{ $set->name }}</b></h4>
                    <small class="text-muted">{{ strtoupper($set->code) }} - {{ $cards->total() }} cards</small>
                </div>
            </div>
        @else
            <h3 class="mb-3"><b>EXPLORE CARDS</b></h3>
        @endisset

        <div class="row g-4">
            @foreach ($cards as $card)
                <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                    <button type="button" class="card-card btn" data-bs-toggle="modal"
                        data-bs-target="#{{ $card->id }}">
                        <img src="{{ $card->img }}" alt="{{ $card->collector_number }}" class="img-fluid" />
                        <p class="card-text">{{ strtoupper($card->set->code) }} - #{{ $card->collector_number }}</p>
                    </button>
                    <x-card-modal :card="$card" />
                </div>
            @endforeach
            <div class="d-flex justify-content-center mt-4">
                {{ $cards->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
