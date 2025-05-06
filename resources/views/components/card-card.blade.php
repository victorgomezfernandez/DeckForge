<div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-2">
    <button type="button" class="card-card btn" data-bs-toggle="modal"
        data-bs-target="#{{ $card->id }}">
        <img src="{{ $card->img }}" alt="{{ $card->collector_number }}" class="img-fluid" />
        <p class="card-text">{{ strtoupper($card->set->code) }} - #{{ $card->collector_number }}</p>
    </button>
    <x-card-modal :card="$card" />
</div>