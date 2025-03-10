 // Custom Dropdown JavaScript
 document.addEventListener('DOMContentLoaded', function () {
    const toggleButton = document.getElementById('custom-dropdown-toggle');
    const dropdownMenu = document.getElementById('custom-dropdown-menu');

    toggleButton.addEventListener('click', function () {
        dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
    });

    document.addEventListener('click', function (event) {
        if (!toggleButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.style.display = 'none';
        }
    });
});
