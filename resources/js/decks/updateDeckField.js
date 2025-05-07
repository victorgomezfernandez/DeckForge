export function updateDeckField() {
    const nameInput = document.getElementById('deckNameInput');
    const descriptionInput = document.getElementById('deckDescriptionInput');
    const deckId = document.getElementById('deck-id')?.value;

    function updateDeckField(field, value) {
        fetch(`/decks/${deckId}/update-field`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ field, value })
        })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    console.error('Update failed');
                }
            })
            .catch(err => {
                console.error('Error updating field:', err);
            });
    }

    if (nameInput) {
        nameInput.addEventListener('blur', (e) => {
            updateDeckField('name', e.target.value.trim());
        });
    }

    if (descriptionInput) {
        descriptionInput.addEventListener('blur', (e) => {
            updateDeckField('description', e.target.value.trim());
        });
    }
}