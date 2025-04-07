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
            <small class="text-muted">{{ strtoupper($set->code) }} - {{ count($cards) }} cards</small>
        </div>
    </div>
    @else
    <h3 class="mb-3"><b>EXPLORE CARDS</b></h3>
    @endisset

    <div class="row g-4">
        @foreach ($cards as $card)
        <div class="col-12 col-sm-6 col-md-4 col-lg-2">
            <button type="button" class="card-card btn" data-bs-toggle="modal" data-bs-target="#{{ $card->id }}">
                <img src="{{ $card->img }}" alt="{{ $card->collector_number }}" class="img-fluid" />
                <p class="card-text">{{ strtoupper($card->set->code) }} - #{{ $card->collector_number }}</p>
            </button>
            <div class="modal fade" id="{{ $card->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered custom-modal-size">                    
                    <div class="modal-content card-modal">
                        <div class="card-img-set">
                            <img src="{{ $card->img }}" alt="{{ $card->collector_number }}"
                                class="card-modal-img" />
                            <span class="set-details">{{ ($card->set->name) }} - {{ strtoupper($card->set->code) }} #{{
                                ($card->collector_number) }}</span>
                        </div>
                        <div class="card-info">
                        @foreach ($card->card_details as $detail)
                        <div class="name-mana">
                        <span>{{ $detail->name }}</span>
                        @foreach ($detail->mana_costs as $mana_cost)
                        @for ($i = 0; $i < $mana_cost->amount; $i++) 
                            <img src="{{ asset("images/costs/{$mana_cost->color->code}.svg") }}" alt="not found" class="cost-img">
                        @endfor
                        @endforeach
                        </div>
                        @foreach ($detail->types as $type)
                        <span class="types-line">{{ $type->name }}</span>
                        @endforeach
                        <p class="oracle-text">{{ $detail->oracle_text }}</p>
                        <i class="flavor-text">{{ $detail->flavor_text }}</i>
                        @endforeach
                        <div class="legalities-grid row row-cols-2 row-cols-sm-3 row-cols-md-4 g-2 mt-3">
                            @foreach ($card->legalities as $legality)
                            <div class="col d-flex align-items-center gap-2">
                                <div class="legality d-flex align-items-center gap-2">
                                <img src="{{ asset('images/legalities/' . $legality->name . '.svg') }}" 
                                     alt="{{ $legality->name }}" 
                                     title="{{ ucfirst($legality->name) }}" 
                                     style="width: 20px; height: 20px;">
                                <span class="small">{{ ucfirst($legality->format->name) }}</span>
                            </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        </div>

        @endforeach
    </div>
</div>

<!-- <script>
    $(document).ready(function() {
        $('p').each(function() {
            var text = $(this).html();
            //text = text.replace(/{T}/g, '<img src="{{ asset('images/icons/tap.svg') }}" alt="Tap">');
            text = text.replace(/{W}/g, '<img src="{{ asset('images/costs/W.svg') }}" alt="White Mana">');
            text = text.replace(/{B}/g, '<img src="{{ asset('images/costs/B.svg') }}" alt="Black Mana">');
            text = text.replace(/{U}/g, '<img src="{{ asset('images/costs/U.svg') }}" alt="Blue Mana">');
            text = text.replace(/{R}/g, '<img src="{{ asset('images/costs/R.svg') }}" alt="Red Mana">');
            text = text.replace(/{G}/g, '<img src="{{ asset('images/costs/G.svg') }}" alt="Green Mana">');
            $(this).html(text);
        });
    });
</script> -->

@endsection