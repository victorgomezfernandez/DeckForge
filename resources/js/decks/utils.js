import { removeCard } from './removeCard';

export function rebindDeleteEvents() {
    const buttons = document.querySelectorAll('.delete-card-button');
    buttons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const card = e.target.closest('.deck-details-card');
            const cardDeckId = card.querySelector('.deck-details-relation-id').value;
            const deckId = card.querySelector('.deck-details-deck-id').value;
            removeCard(cardDeckId, deckId);
        });
    });
}
