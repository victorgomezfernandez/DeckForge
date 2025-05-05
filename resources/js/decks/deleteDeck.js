export function deleteDeck() {
    const deleteButton = document.getElementById('deck-delete');
    const deckId = document.getElementById('deck-id')?.value;

    if (deleteButton && deckId) {
        deleteButton.addEventListener('click', () => {

            fetch(`/decks/${deckId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                }
            })
            .then(response => {
                if (response.ok) {
                    window.location.href = '/your-decks';
                } else {
                    alert('Failed to delete the deck.');
                }
            })
            .catch(error => {
                console.error('Error deleting deck:', error);
                alert('An error occurred while deleting the deck.');
            });
        });
    }
}
