<div class="modal fade" id="{{ $card->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered custom-modal-size">
        <div class="modal-content card-modal">
            <div class="card-img-set">
                <img src="{{ $card->img }}" alt="{{ $card->collector_number }}"
                    class="card-modal-img" />
                <span class="set-details">{{ $card->set->name }} -
                    {{ strtoupper($card->set->code) }} #{{ $card->collector_number }}</span>
            </div>
            <div class="card-info">
                @foreach ($card->card_details as $detail)
                    <div class="name-mana">
                        <span>{{ Str::limit($detail->name, 30, '...') }}</span>
                        @foreach ($detail->mana_costs as $mana_cost)
                            @for ($i = 0; $i < $mana_cost->amount; $i++)
                                <img src="{{ asset("images/costs/{$mana_cost->color->code}.svg") }}"
                                    alt="not found" class="cost-img">
                            @endfor
                        @endforeach
                    </div>
                    @foreach ($detail->types as $type)
                        <span class="types-line">{{ $type->name }}</span>
                    @endforeach
                    <p class="oracle-text">{!! renderOracleText($detail->oracle_text) !!}</p>
                    <i class="flavor-text">{!! nl2br(e($detail->flavor_text)) !!}</i>
                @endforeach
                <div class="legalities-grid row row-cols-2 row-cols-sm-3 row-cols-md-4 g-2 mt-3">
                    @foreach ($card->legalities as $legality)
                        <div class="col d-flex align-items-center gap-2">
                            <div class="legality d-flex align-items-center gap-2">
                                <img src="{{ asset('images/legalities/' . $legality->name . '.svg') }}"
                                    alt="{{ $legality->name }}" title="{{ ucfirst($legality->name) }}"
                                    style="width: 20px; height: 20px;">
                                <span class="small">{{ ucfirst($legality->format->name) }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
        </div>
    </div>
</div>