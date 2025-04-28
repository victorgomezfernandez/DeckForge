import { rebindDeleteEvents } from './utils';

export function removeCard(cardDeckId, deckId) {
    fetch(`/decks/${deckId}/remove-card/${cardDeckId}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                fetch(`/decks/deck-details/${deckId}/cards-html`)
                    .then(res => res.text())
                    .then(html => {
                        document.getElementById('deck-card-list').innerHTML = html;
                        rebindDeleteEvents();
                    });
                fetch(`/decks/deck-details/${deckId}/colors-html`)
                    .then(res => res.text())
                    .then(html => {
                        document.getElementById('deck-colors').innerHTML = html;

                    });
            } else {
                alert('No se pudo eliminar la carta');
            }
        })
        .catch(err => {
            console.error('Error al eliminar:', err);
            alert('Ocurrió un error al eliminar');
        });
}
