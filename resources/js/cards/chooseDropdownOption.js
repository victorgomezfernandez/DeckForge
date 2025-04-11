export function chooseDropdownOption(){
    document.querySelectorAll('.dropdown-item').forEach(function (item) {
        item.addEventListener('click', function () {
            var selectedValue = item.getAttribute('data-value');
            document.getElementById('selectedOption').value = selectedValue;
            document.getElementById('dropdownMenuButton').textContent = selectedValue;
        });
    });
}