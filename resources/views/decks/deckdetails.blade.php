@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="deck-details col-lg-6">
                <div class="deck-details-header">
                    <span class="deck-details-name">
                        {{ $deck->name }}
                    </span>
                    <div class="deck-details-colors">
                        @foreach ($deck->colors as $color)
                            <img src="{{ asset("images/costs/{$color->code}.svg") }}">
                        @endforeach
                    </div>
                    <div class="deck-details-tag">
                        <span>Format: {{ Str::ucfirst($deck->format->name) }}</span>
                    </div>
                    <div class="deck-details-tag">
                        <span>Card count: {{ count($deck->cards) }}</span>
                    </div>
                </div>
                <span class="deck-details-description">{{ $deck->description }}</span>
                <span class="deck-details-description">By {{ $deck->user->name }}</span>
            </div>
            <div class="col-lg-6 d-flex flex-column align-items-end">
                <div class="d-flex align-items-center justify-content-end gap-2 mb-2"
                    style="width: 100%; max-width: 300px;">
                    <label for="card-live-search" class="mb-0"><b>Add Cards</b></label>
                    <input type="search" id="card-live-search" class="form-control live-search-input" />
                </div>

                <div class="position-relative" style="width: 100%; max-width: 300px;">
                    <ul id="card-results" class="list-group position-absolute live-search-results">
                    </ul>
                </div>
            </div>
        </div>
        @php
            $displayedCardIds = collect();
            $typePriority = ['Creature', 'Artifact', 'Enchantment', 'Instant', 'Sorcery', 'Land'];
        @endphp

        <div class="row mt-4">
            @foreach ($typePriority as $type)
                @php
                    $cardsByType = $deck->cards->filter(function ($card) use ($type, $displayedCardIds) {
                        if ($displayedCardIds->contains($card->id)) {
                            return false;
                        }

                        foreach ($card->card_details as $cardDetail) {
                            foreach ($cardDetail->types as $cardType) {
                                if ($cardType->name === $type) {
                                    return true;
                                }
                            }
                        }

                        return false;
                    });
                @endphp

                @if ($cardsByType->isNotEmpty())
                    <div class="col-md-6 col-lg-4 mb-4">
                        <h5 class="fw-bold">
                            {{ $type === 'Sorcery' ? 'Sorceries' : $type . 's' }}
                        </h5>

                        @foreach ($cardsByType->groupBy('id') as $cardGroup)
                            @php
                                $card = $cardGroup->first();
                                $quantity = $cardGroup->count();
                                $displayedCardIds->push($card->id);
                            @endphp

                            <div class="deck-details-card d-flex justify-content-between align-items-center">
                                <span class="deck-details-card-name">
                                    {{ $quantity }} {{ $card->card_details[0]->name }}
                                </span>
                                <div class="deck-details-card-costs d-flex">
                                    @foreach ($card->card_details as $detail)
                                        @foreach ($detail->mana_costs as $mana_cost)
                                            @for ($i = 0; $i < $mana_cost->amount; $i++)
                                                <img src="{{ asset("images/costs/{$mana_cost->color->code}.svg") }}"
                                                    alt="not found" class="cost-img">
                                            @endfor
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            @endforeach
        </div>


        <input type="hidden" id="deck-id" value="{{ $deck->id }}">
    @endsection
