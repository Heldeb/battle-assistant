/* import './stimulus_bootstrap.js';
import './styles/app.css';

const button = document.querySelector('.menu-toggle');
const menu = document.querySelector('.nav-links');

button.addEventListener('click', () => {
    menu.classList.toggle('active');
}); */

const dropdownToggle = document.querySelector('.dropdown-toggle');
const dropdownMenu = document.querySelector('.dropdown-menu');

dropdownToggle.addEventListener('click', (e) => {
    e.stopPropagation();
    const isOpen = dropdownMenu.classList.toggle('is-open');
    dropdownToggle.setAttribute('aria-expanded', isOpen);
});

// Fermer en cliquant ailleurs
document.addEventListener('click', (e) => {
    if (!e.target.closest('.dropdown')) {
        dropdownMenu.classList.remove('is-open');
        dropdownToggle.setAttribute('aria-expanded', 'false');
    }
});

// Fermer avec la touche Échap
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        dropdownMenu.classList.remove('is-open');
        dropdownToggle.setAttribute('aria-expanded', 'false');
    }
});