<script>
    // JavaScript para capturar el valor seleccionado y actualizar el texto del botón
    document.querySelectorAll('.dropdown-item').forEach(function (item) {
        item.addEventListener('click', function () {
            var selectedValue = item.getAttribute('data-value');
            document.getElementById('selectedOption').value = selectedValue; // Asignar valor al campo oculto
            document.getElementById('dropdownMenuButton').textContent = selectedValue; // Cambiar texto del botón
        });
    });
</script>