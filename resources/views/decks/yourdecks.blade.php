@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row g-4">
            @foreach ($decks as $deck)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="deck-card" style="background-image: url('{{ $deck->img }}')">
                        <div class="deck-text">
                            <span class="deck-name">{{ $deck->name }}</span>
                            <span class="deck-format">{{ $deck->format->name }}</span>
                            <span class="deck-creator">{{ $deck->user->name }}</span>
                        </div>
                        <div class="deck-colors">
                            @forelse ($deck->colors as $color)
                                <img src="{{ asset("images/costs/{$color->code}.svg") }}"
                                    alt="images/costs/{$color->code}.svg" class="deck-color">
                            @empty
                                
                            @endforelse
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
