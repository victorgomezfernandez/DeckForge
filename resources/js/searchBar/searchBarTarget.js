export function searchBarTarget() {
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('searchForm');
        const typeSelect = document.getElementById('selectedType');

        const typeToRoute = {
            Cards: window.routes.cards,
            Decks: window.routes.decks,
            Sets: window.routes.sets,
        };

        typeSelect.addEventListener('change', function () {
            const selectedType = typeSelect.value;
            form.action = typeToRoute[selectedType] || window.routes.cards;
        });

        const selectedType = typeSelect.value;
        form.action = typeToRoute[selectedType] || window.routes.cards;
    });

}
