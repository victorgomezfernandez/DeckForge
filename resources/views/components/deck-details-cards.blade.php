@php
    $displayedCardIds = collect();
    $typePriority = ['Creature', 'Artifact', 'Enchantment', 'Instant', 'Sorcery', 'Land'];
    $isCreator = auth()->check() && auth()->user()->id === $deck->user->id;
@endphp

<div class="row mt-4">
    <div class="col-lg-9">
        <div class="row">
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
                    <div class="col-md-6 col-lg-4 mb-4" id="section-{{ strtolower($type) }}">
                        @php
                            $totalCount = $cardsByType->count();
                        @endphp
                        @php
                            $translatedType = __(
                                'decks.types.' . strtolower($type) . '.' . ($totalCount === 1 ? 'singular' : 'plural'),
                            );
                        @endphp
                        <h4 class="fw-bold">{{ $totalCount }} {{ $translatedType }}</h4>


                        @foreach ($cardsByType->groupBy('id') as $cardGroup)
                            @php
                                $card = $cardGroup->first();
                                $quantity = $cardGroup->count();
                                $displayedCardIds->push($card->id);

                                $legality = $card->legalities->where('format_id', $deck->format_id)->first();
                            @endphp


                            <div class="deck-details-card d-flex justify-content-between align-items-center"
                                data-card="{{ json_encode($card) }}" data-art-crop="{{ $card->art_crop ?? '' }}">
                                <span class="deck-details-card-name">
                                    {{ $quantity }} {{ Str::limit($card->card_details[0]->name, 1000, '...') }}
                                </span>
                                <input type="hidden" class="deck-details-card-id" value={{ $card->id }}>
                                <input type="hidden" class="deck-details-relation-id" value={{ $card->pivot->id }}>
                                <input type="hidden" class="deck-details-deck-id" value={{ $deck->id }}>
                                <div class="deck-details-card-costs d-flex">
                                    @foreach ($card->card_details as $detail)
                                        @foreach ($detail->mana_costs as $mana_cost)
                                            @for ($i = 0; $i < $mana_cost->amount; $i++)
                                                <img src="{{ asset("images/costs/{$mana_cost->color->code}.svg") }}"
                                                    alt="not found" class="cost-img">
                                            @endfor
                                        @endforeach
                                    @endforeach
                                    @if ($legality)
                                        @if ($legality->name === 'banned' || $legality->name === 'not_legal')
                                            <img src="{{ asset('images/legalities/banned.svg') }}"
                                                title="{{ __('decks.not_legal') }} {{ $deck->format->name }}"
                                                style="width: 20px; height: 20px;">
                                        @elseif ($legality->name === 'restricted')
                                            <img src="{{ asset('images/legalities/restricted.svg') }}"
                                                title="{{ __('decks.restricted') }} {{ $deck->format->name }}"
                                                style="width: 20px; height: 20px;">
                                        @endif
                                    @endif


                                    @if ($isCreator)
                                        <button class="btn delete-card-button">
                                            <i class="fa-solid fa-x" style="color: #D82596"></i>
                                        </button>
                                    @endif
                                </div>
                                <x-card-modal :card="$card" />
                            </div>
                        @endforeach
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <div class="col-lg-3 d-flex flex-column">
        <div id="selected-card-info">
        </div>
    </div>

</div>

<script>
    window.translations = {
        viewDetails: @json(__('decks.view_details')),
        setAsThumbnail: @json(__('decks.set_as_thumbnail')),
    };
</script>
