import 'bootstrap';

const navToggle = document.querySelector('[data-nav-toggle]');
const nav = document.querySelector('[data-site-nav]');

if (navToggle && nav) {
    navToggle.addEventListener('click', () => {
        const expanded = navToggle.getAttribute('aria-expanded') === 'true';
        navToggle.setAttribute('aria-expanded', String(!expanded));
        nav.classList.toggle('is-open', !expanded);
    });
}
