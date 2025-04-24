import { addCardToDeck } from './addCard';

export function setupLiveSearch() {
    const input = document.getElementById('card-live-search');
    const results = document.getElementById('card-results');
    let timeout = null;

    if (!input || !results) return;

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
                .then(res => res.json())
                .then(data => {
                    results.innerHTML = '';
                    if (data.length === 0) {
                        results.innerHTML = '<li class="list-group-item">No cards found.</li>';
                    } else {
                        data.forEach(card => {
                            const li = document.createElement('li');
                            li.classList.add('list-group-item', 'live-search-card');

                            const name = card.card_details[0]?.name ?? 'Unnamed';
                            const setCode = card.set?.code?.toUpperCase() ?? 'Unknown';
                            const number = card.collector_number ?? 'N/A';
                            const lang = card.lang ?? 'N/A';
                            li.textContent = `${name} - ${setCode} - ${number} - ${lang}`;

                            li.dataset.card = JSON.stringify(card);
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
