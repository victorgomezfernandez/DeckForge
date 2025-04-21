export function resetFilters() {
    document.getElementById('resetAdvancedFilters')?.addEventListener('click', function () {
        document.querySelector('input[name="deck_name"]').value = '';
        document.querySelector('select[name="deck_format"]').value = '';
        document.querySelector('input[name="deck_creator"]').value = '';
    });
    document.getElementById('filtersClose')?.addEventListener('click', function () {
        document.querySelector('input[name="deck_name"]').value = '';
        document.querySelector('select[name="deck_format"]').value = '';
        document.querySelector('input[name="deck_creator"]').value = '';
    });
}