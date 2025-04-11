export function setupSetThumbnail() {
    document.addEventListener('click', function (e) {
        if (e.target?.id !== 'set-thumbnail-btn') return;

        const deckId = document.getElementById('deck-id').value;
        const artCrop = e.target.getAttribute('data-art-crop');

        fetch(`/decks/${deckId}/update-thumbnail`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ art_crop: artCrop })
        })
            .then(res => res.json())
            .then(data => {
                if (!data.success) {
                    console.log('No se pudo actualizar thumbnail');
                }
            })
            .catch(err => {
                console.error('Error al actualizar thumbnail:', err);
                alert('Ocurrió un error');
            });
    });
}
