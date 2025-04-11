export function setupCardSelection() {
    document.addEventListener('click', function (e) {
        const clickedCard = e.target.closest('.deck-details-card');
        if (!clickedCard) return;

        const card = JSON.parse(clickedCard.dataset.card);
        const userId = document.getElementById('user-id').value;
        const creatorId = document.getElementById('creator-id').value;

        const html = `
            <img src="${card.img ?? ''}" alt="not_found" class="img-fluid selected-card-img"/>
            <button type="button" class="btn deck-details-tag" data-bs-toggle="modal" data-bs-target="#${card.id}">
                View Details
            </button>
            ${userId === creatorId ? `<button class="btn deck-details-tag" id="set-thumbnail-btn" data-card-id="${card.id}" data-art-crop="${card.art_crop}">Set as Thumbnail</button>` : ''}
        `;
        document.getElementById('selected-card-info').innerHTML = html;
    });
}
