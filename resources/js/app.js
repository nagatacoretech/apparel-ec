import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;
document.addEventListener('DOMContentLoaded', function() {
    const searchIcon = document.getElementById('searchIcon');
    const searchBox = document.getElementById('searchBox');

    searchIcon.addEventListener('click', function() {
        if (searchBox.style.display === 'none' || searchBox.style.display === '') {
            searchBox.style.display = 'block';
            searchBox.classList.add('slideDown');
        } else {
            searchBox.style.display = 'none';
            searchBox.classList.remove('slideDown');
        }
    });
});
Alpine.start();
