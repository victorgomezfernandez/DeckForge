document.addEventListener('DOMContentLoaded', function () {
    const deleteIcons = document.querySelectorAll('.fa-x');
    deleteIcons.forEach(icon => {
        icon.addEventListener('click', function (e) {
            e.preventDefault();
            const cardId = e.target.closest('.deck-details-card').querySelector('.deck-details-card-id').value;
            const deckId = e.target.closest('.deck-details-card').querySelector('.deck-details-deck-id').value;
            removeCard(cardId, deckId);
        })
    })
    const input = document.getElementById('card-live-search');
    const results = document.getElementById('card-results');
    let timeout = null;
    if (input && results) {
        input.addEventListener('keyup', function () {
            const query = this.value;

            clearTimeout(timeout);

            if (query.length < 3) {
                results.style.display = 'none';
                results.innerHTML = '';
                return;
            }

            timeout = setTimeout(() => {
                fetch(`/cards/live-search?q=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        results.innerHTML = '';

                        if (data.length === 0) {
                            results.innerHTML = '<li class="list-group-item">No cards found.</li>';
                        } else {
                            data.forEach(card => {
                                const li = document.createElement('li');
                                li.classList.add('list-group-item');

                                const cardName = card.card_details[0]?.name ?? 'Unnamed';
                                const setCode = card.set?.code.toUpperCase() ?? 'Unknown';
                                const collectorNumber = card.collector_number ?? 'N/A';
                                li.textContent = `${cardName} - ${setCode} - ${collectorNumber}`;

                                li.dataset.card = JSON.stringify(card);

                                li.classList.add('live-search-card');

                                li.addEventListener('click', function () {
                                    const card = JSON.parse(this.dataset.card);
                                    addCardToDeck(card, input);
                                    results.style.display = 'none';
                                });

                                results.appendChild(li);
                            });
                        }

                        results.style.display = 'block';
                    });
            }, 300);
        });
    }
});

function addCardToDeck(card, input) {
    const cardAmountElement = document.getElementById('deck-details-count');
    const deckId = document.getElementById('deck-id').value;
    input.value = "";
    fetch('/decks/deck-details/' + deckId + '/add-card', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            deck_id: deckId,
            card: card
        })
    })
        .then(response => response.json())
        .then(() => {
            fetch('/decks/deck-details/' + deckId + '/cards-html')
                .then(response => response.text())
                .then(html => {
                    document.getElementById('deck-card-list').innerHTML = html;
                });
            cardAmountElement.textContent = parseInt(cardAmountElement.textContent) + 1;
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

document.addEventListener('click', function (e) {
    const clickedCard = e.target.closest('.deck-details-card');
    if (!clickedCard) return;

    const cardData = clickedCard.dataset.card;
    const card = JSON.parse(cardData);

    const cardId = card.id ?? 'ID not found';
    const cardImg = card.img ?? '';
    const authUserId = document.getElementById('user-id').value;
    const creatorId = document.getElementById('creator-id').value;

    if ((authUserId && creatorId) && (authUserId === creatorId)) {
        document.getElementById('selected-card-info').innerHTML = `
        <img src="${cardImg}" alt="not_found" class="img-fluid selected-card-img"/>
        <button type="button" class="btn deck-details-tag" data-bs-toggle="modal" data-bs-target="#${cardId}">
            View Details
        </button>
        <button class="btn deck-details-tag" id="set-thumbnail-btn" data-card-id="${card.id}" data-art-crop="${card.art_crop}">Set as Thumbnail</button>
    `;
    } else {

        document.getElementById('selected-card-info').innerHTML = `
        <img src="${cardImg}" alt="not_found" class="img-fluid selected-card-img"/>
        <button type="button" class="btn deck-details-tag" data-bs-toggle="modal" data-bs-target="#${cardId}">
            View Details
        </button>
    `;
    }
});

document.addEventListener('click', function (e) {
    if (e.target && e.target.id === 'set-thumbnail-btn') {
        const deckId = document.getElementById('deck-id').value;
        const artCropImg = e.target.getAttribute('data-art-crop');

        fetch(`/decks/${deckId}/update-thumbnail`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                art_crop: artCropImg
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Deck image updated successfully');
                } else {
                    console.log('Could not update the deck thumbnail');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while updating the deck image');
            });
    }
});

function removeCard(cardId, deckId) {
    fetch(`/decks/${deckId}/remove-card/${cardId}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                e.target.closest('.deck-details-card').remove();
            } else {
                alert('No se pudo eliminar la carta');
            }
        })
        .catch(error => {
            console.error('Error al eliminar la carta:', error);
            alert('Ocurrió un error al intentar eliminar la carta');
        });
}