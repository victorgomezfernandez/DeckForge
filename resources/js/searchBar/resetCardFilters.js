export function resetCardFilters() {
    document.getElementById('resetCardFilters')?.addEventListener('click', function () {
        document.querySelector('input[name="card_name"]').value = '';
        document.querySelector('input[name="card_types"]').value = '';
        document.querySelector('input[name="card_power"]').value = '';
        document.querySelector('input[name="card_toughness"]').value = '';
        document.querySelector('input[name="card_value"]').value = '';
        document.querySelector('select[name="card_set"]').value = '';
        const colorCheckboxes = document.querySelectorAll('input[name="colors[]"]');
        colorCheckboxes.forEach(checkbox => {
            checkbox.checked = false;
        });
    });
    document.getElementById('filtersClose')?.addEventListener('click', function () {
        if (document.querySelector('input[name="card_name"]')) {
            document.querySelector('input[name="card_name"]').value = '';
            document.querySelector('input[name="card_types"]').value = '';
            document.querySelector('input[name="card_power"]').value = '';
            document.querySelector('input[name="card_toughness"]').value = '';
            document.querySelector('input[name="card_value"]').value = '';
            document.querySelector('select[name="card_set"]').value = '';
            const colorCheckboxes = document.querySelectorAll('input[name="colors[]"]');
            colorCheckboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
        }
    });
}