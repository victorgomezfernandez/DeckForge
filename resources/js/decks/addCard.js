import { rebindDeleteEvents } from './utils';

export function addCardToDeck(card, input) {
    const cardAmountElement = document.getElementById('deck-details-count');
    const deckId = document.getElementById('deck-id').value;
    input.value = "";

    fetch(`/decks/deck-details/${deckId}/add-card`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ deck_id: deckId, card })
    })
        .then(res => res.json())
        .then(() => {
            fetch(`/decks/deck-details/${deckId}/cards-html`)
                .then(res => res.text())
                .then(html => {
                    document.getElementById('deck-card-list').innerHTML = html;
                    rebindDeleteEvents();
                    cardAmountElement.textContent = parseInt(cardAmountElement.textContent) + 1;
                });
        })
        .catch(console.error);
}
