document.getElementById('notification-button').addEventListener('click', function(event) {
    event.stopPropagation(); // Prevent the click event from bubbling up to document
    var dropdown = document.getElementById('notification-dropdown');
    if (dropdown.classList.contains('hidden')) {
        dropdown.classList.remove('hidden');
    } else {
        dropdown.classList.add('hidden');
    }
});

document.addEventListener('click', function(event) {
    var dropdown = document.getElementById('notification-dropdown');
    var button = document.getElementById('notification-button');
    if (!button.contains(event.target) && !dropdown.contains(event.target)) {
        dropdown.classList.add('hidden');
    }
});