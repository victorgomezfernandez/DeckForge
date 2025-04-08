
document.querySelectorAll('.dropdown-item').forEach(item => {
    item.addEventListener('click', event => {
        event.preventDefault();
        const value = item.getAttribute('data-value');
        document.getElementById('selectedFormat').value = value;
        document.getElementById('selectedFormatLabel').textContent = value;
    });
});
