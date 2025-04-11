import { removeCard } from './removeCard';

export function rebindDeleteEvents() {
    const icons = document.querySelectorAll('.fa-x');
    icons.forEach(icon => {
        icon.addEventListener('click', function (e) {
            e.preventDefault();
            const card = e.target.closest('.deck-details-card');
            const cardDeckId = card.querySelector('.deck-details-relation-id').value;
            const deckId = card.querySelector('.deck-details-deck-id').value;
            removeCard(cardDeckId, deckId);
        });
    });
}
