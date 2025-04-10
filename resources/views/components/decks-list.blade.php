@props(['decks'])
<div class="row g-4">
    @foreach ($decks as $deck)
        <div class="col-12 col-sm-6 col-md-4 col-lg-2">
            <a href="/decks/deck-details/{{ $deck->id }}" style="text-decoration: none;">
                <div class="deck-card">
                    <img src="{{ $deck->img }}" alt="" class="deck-background">
                    <div class="deck-card-content">
                        <div class="deck-text">
                            <span class="deck-name">{{ $deck->name }}</span>
                            <span class="deck-format">{{ ucfirst($deck->format->name) }}</span>
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
            </a>
        </div>
    @endforeach
</div>