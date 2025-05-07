<div class="modal fade" id="createDeckModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="btn-close create-deck-modal-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
            <div class="modal-body create-deck-modal-body">
                <span class="modal-title w-100 text-center create-deck-modal-header"
                    id="staticBackdropLabel">{{ __('decks.create_new_deck') }}</span>
                <form action="{{ route('decks.store') }}" method="POST" class="create-deck-form">
                    @csrf
                    <div class="mb-3 w-100">
                        <label for="deck-name" class="form-label">{{ __('decks.name') }}</label>
                        <input type="text" class="form-control create-deck-modal-input" id="deck-name"
                            name="name">
                    </div>
                    <div class="mb-3 w-100">
                        <label for="deck-description" class="form-label">{{ __('decks.description') }}</label>
                        <input type="text" class="form-control create-deck-modal-input" id="deck-description"
                            name="description">
                    </div>
                    <div class="mb-3 w-100">
                        <label for="deck-format" class="form-label">{{ __('decks.format') }}</label>
                        <select name="format" id="selectedFormat" class="deck-create-format form-select">
                            <option value="Standard">Standard</option>
                            <option value="Vintage">Vintage</option>
                        </select>
                    </div>
                    <div class="form-check">
                        <input type="hidden" name="public" value="0">
                        <input type="checkbox" class="form-check-input" value="1" id="isPublic" name="public">
                        <label for="isPublic" class="form-check-label">
                            {{ __('decks.set_as_public') }}
                        </label>
                    </div>
                    <button type="submit"
                        class="btn btn-primary w-100 create-deck-modal-submit">{{ __('decks.create') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
