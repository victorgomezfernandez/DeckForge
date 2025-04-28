<div class="deck-details-colors">
    @foreach ($deck->colors as $color)
        <img src="{{ asset("images/costs/{$color->code}.svg") }}">
    @endforeach
</div>