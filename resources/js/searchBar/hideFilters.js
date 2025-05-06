export function hideFilters() {
    const selectedType = document.getElementById('selectedType');
    const filtersButton = document.getElementById('filtersButton');
    if (selectedType && filtersButton) {
        selectedType.addEventListener('click', function () {
            if (selectedType.value == "Sets") {
                filtersButton.style.display = 'none';
            } else {
                filtersButton.style.display = 'flex';
            }
        });
    }
}