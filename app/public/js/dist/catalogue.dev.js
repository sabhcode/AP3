"use strict";

// Récupérez l'élément select
var selectCategory = document.getElementById("category-filter"); // Parcourez les options

function selectToLink() {
  var currentOption = selectCategory.options[selectCategory.selectedIndex].getAttribute('data-url');
  console.log(currentOption); // pour debug

  window.location.href = "http://" + window.location.host + currentOption;
}