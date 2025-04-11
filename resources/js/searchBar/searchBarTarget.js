export function searchBarTarget() {
    const form = document.getElementById('searchForm');
    const selectedTypeInput = document.getElementById('selectedType');
    const path = window.location.pathname;
    if (path.includes('/decks')) {
        form.action = '/decks/search-decks';
    } else {
        form.action = '/cards/search-cards';
    }
    document.querySelectorAll('.dropdown-item').forEach(function (item) {
        item.addEventListener('click', function () {
            var selectedValue = item.getAttribute('data-value');
            document.getElementById('dropdownMenu').textContent = selectedValue;
            selectedTypeInput.value = selectedValue;
            switch (selectedValue) {
                case 'Cards':
                    form.action = '/cards/search-cards';
                    break;
                case 'Sets':
                    form.action = '/cards/sets/search-sets';
                    break;
                case 'Decks':
                    form.action = '/decks/search-decks';
                    break;
            }
        });
    });
}