// Début du code du slider
let currentSlide = 0;
const cards = document.querySelectorAll('.card');
const prevButton = document.getElementById('prevButton');
const nextButton = document.getElementById('nextButton');

function showSlide(n) {
    cards[currentSlide].style.display = 'none';
    currentSlide = (n + cards.length) % cards.length;
    cards[currentSlide].style.display = 'block';
}

function nextSlide() {
    showSlide(currentSlide + 1);
}

function previousSlide() {
    showSlide(currentSlide - 1);
}

// Afficher la première carte au chargement de la page
showSlide(currentSlide);

// Gestion des événements pour les boutons de navigation
prevButton.addEventListener('click', previousSlide);
nextButton.addEventListener('click', nextSlide);
// Fin du code du slider
