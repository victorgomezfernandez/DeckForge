const input = document.getElementById('card-live-search');
const results = document.getElementById('card-results');
let timeout = null;

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
                            addCardToDeck(card);
                        });

                        results.appendChild(li);
                    });
                }

                results.style.display = 'block';
            });
    }, 300);
});

function addCardToDeck(card) {
    const deckId = document.getElementById('deck-id').value;
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
        .then(data => {
            console.log(data);
            window.location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
        });
}