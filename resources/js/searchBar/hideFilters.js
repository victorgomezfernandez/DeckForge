export function hideFilters() {
    const selectedType = document.getElementById('selectedType');
    const filtersButton = document.getElementById('filtersButton');
    if (selectedType) {
        selectedType.addEventListener('click', function () {
            if (selectedType.value == "Sets") {
                console.log('clicao');
                filtersButton.style.display = 'none';
            } else {
                filtersButton.style.display = 'flex';
            }
        });
    }
}