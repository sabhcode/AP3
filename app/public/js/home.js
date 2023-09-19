// Début du code du slider
let currentSlide = 0;
const cards = document.querySelectorAll('.card');
const prevButton = document.getElementById('prevButton');
const nextButton = document.getElementById('nextButton');
let transitioning = false; // Variable pour éviter les transitions en cours

function showSlide(n) {
    if (transitioning) return; // Éviter les transitions en cours
    transitioning = true;

    const previousSlide = cards[currentSlide];
    currentSlide = (n + cards.length) % cards.length;
    const currentSlideElement = cards[currentSlide];

    // Masquer la diapositive précédente avec une animation de fondu
    fadeOut(previousSlide, () => {
        // Afficher la diapositive actuelle avec une animation de fondu
        fadeIn(currentSlideElement, () => {
            transitioning = false; // Autoriser de nouvelles transitions
        });
    });
}

function fadeIn(element, callback) {
    let opacity = 0;
    element.style.display = 'block';

    const interval = setInterval(function () {
        opacity += 0.05; // Augmenter progressivement l'opacité
        element.style.opacity = opacity;

        if (opacity >= 1) {
            clearInterval(interval); // Arrêter l'animation lorsque l'opacité atteint 1
            if (callback) callback();
        }
    }, 20); // Répéter toutes les 20 millisecondes pour une transition fluide
}

function fadeOut(element, callback) {
    let opacity = 1;

    const interval = setInterval(function () {
        opacity -= 0.7; // Diminuer progressivement l'opacité
        element.style.opacity = opacity;

        if (opacity <= 0) {
            element.style.display = 'none'; // Masquer l'élément lorsque l'opacité atteint 0
            clearInterval(interval); // Arrêter l'animation
            if (callback) callback();
        }
    }, 20); // Répéter toutes les 20 millisecondes pour une transition fluide
}

// Afficher la première carte au chargement de la page
fadeIn(cards[currentSlide]);

// Gestion des événements pour les boutons de navigation
prevButton.addEventListener('click', () => showSlide(currentSlide - 1));
nextButton.addEventListener('click', () => showSlide(currentSlide + 1));
// Fin du code du slider
