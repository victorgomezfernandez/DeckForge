export function resizeAreas() {
    const nameInput = document.getElementById('deckNameInput');
    const descriptionInput = document.getElementById('deckDescriptionInput');

    function autoResizeTextarea(el) {
        el.style.height = 'auto';
        el.style.height = (el.scrollHeight) + 'px';
    }

    function enforceMaxLength(input, max) {
        input.addEventListener('input', function () {
            if (input.value.length > max) {
                input.value = input.value.slice(0, max);
            }
            autoResizeTextarea(input);
        });
    }

    if (nameInput) {
        autoResizeTextarea(nameInput);
        enforceMaxLength(nameInput, 25);
    }

    if (descriptionInput) {
        autoResizeTextarea(descriptionInput);
        enforceMaxLength(descriptionInput, 200);
    }
}