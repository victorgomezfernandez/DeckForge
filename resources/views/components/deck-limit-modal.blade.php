<li class="nav-item">
    <button class="btn" type="button" data-bs-toggle="modal" data-bs-target="#createDeckModal">
        <img class="add-deck-img" src="{{ asset('images/add.svg') }}" alt="add deck">
    </button>
    <div class="modal fade" id="createDeckModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close create-deck-modal-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
                <div class="modal-body create-deck-modal-body">
                    <span class="modal-title w-100 text-center create-deck-modal-header"
                        id="staticBackdropLabel">{{ __('decks.limit_reached') }}</span>
                    <span>{{ __('decks.subscribe_notice') }}</p>
                        <a href="{{ route('pricing') }}">
                            <button type="submit"
                                class="btn btn-primary w-100 create-deck-modal-submit">{{ __('decks.subscribe') }}</button></a>
                        </form>
                </div>
            </div>
        </div>
    </div>
</li>
