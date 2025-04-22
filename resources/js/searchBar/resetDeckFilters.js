export function resetDeckFilters() {
    document.getElementById('resetDeckFilters')?.addEventListener('click', function () {
        document.querySelector('input[name="deck_name"]').value = '';
        document.querySelector('select[name="deck_format"]').value = '';
        document.querySelector('input[name="deck_creator"]').value = '';
        const colorCheckboxes = document.querySelectorAll('input[name="colors[]"]');
        colorCheckboxes.forEach(checkbox => {
            checkbox.checked = false;
        });
    });
    document.getElementById('filtersClose')?.addEventListener('click', function () {
        document.querySelector('input[name="deck_name"]').value = '';
        document.querySelector('select[name="deck_format"]').value = '';
        document.querySelector('input[name="deck_creator"]').value = '';
        const colorCheckboxes = document.querySelectorAll('input[name="colors[]"]');
        colorCheckboxes.forEach(checkbox => {
            checkbox.checked = false;
        });
    });
}