document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('.create-deck-form');
    const nameInput = document.getElementById('deck-name');
    const formatInput = document.getElementById('selectedFormat');

    if (form && nameInput && formatInput) {

        function validateForm() {
            let hasError = false;

            if (!nameInput.value.trim()) {
                nameInput.classList.add('is-invalid');
                hasError = true;
            } else {
                nameInput.classList.remove('is-invalid');
            }

            if (!formatInput.value.trim()) {
                formatDropdown.classList.add('border', 'border-danger');
                hasError = true;
            } else {
                formatDropdown.classList.remove('border', 'border-danger');
            }

            return !hasError;
        }

        form.addEventListener('submit', function (e) {
            if (!validateForm()) {
                e.preventDefault();
            }
        });
    }
});
