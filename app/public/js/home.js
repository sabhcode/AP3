// Début Code du slider 

let currentSlide = 0;
const slides = document.querySelectorAll('.slider-image');
const prevButton = document.getElementById('prevButton');
const nextButton = document.getElementById('nextButton');

function showSlide(n) {
    slides[currentSlide].style.display = 'none';
    currentSlide = (n + slides.length) % slides.length;
    slides[currentSlide].style.display = 'block';
}

function nextSlide() {
    showSlide(currentSlide + 1);
}

function previousSlide() {
    showSlide(currentSlide - 1);
}

// Afficher la première image au chargement de la page
showSlide(currentSlide);

// Gestion des événements pour les boutons de navigation
prevButton.addEventListener('click', previousSlide);
nextButton.addEventListener('click', nextSlide);


// Fin Code du slider