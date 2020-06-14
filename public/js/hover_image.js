// recuperation du bouton qui contient l'input 
const copyBtn = document.getElementById("labelFile");
// recuperation du block qui contien l'image et le bouton type file
const resultContainer = document.querySelector(".result");

//getBoundingClientRect = renvoie la taille de l'élément et sa position par rapport à la zone d'affichage (ecran)
resultContainer.addEventListener("mousemove", e => {
    resultContainerBound = {
        left: resultContainer.getBoundingClientRect().left,
        top: resultContainer.getBoundingClientRect().top,
    };
    // recupere les coordonné de la souris pour les donner au bouton
        copyBtn.style.opacity = '1';
        copyBtn.style.pointerEvents = 'all';
        copyBtn.style.setProperty("--x", `${e.x - resultContainerBound.left}px`);
        copyBtn.style.setProperty("--y", `${e.y - resultContainerBound.top}px`);

});
// récupère la div qui contiendra l'image choisis
var output = document.getElementById('output');
// récupère l'input file pour avoir sa valeur
var file = document.getElementById('file');

// récupère la valeur de 'linput type file et affilie la valeur
// au SRC de <img> pour afficher l'image selectionné
file.onchange = function() {
  var url = URL.createObjectURL(this.files[0]);
  console.log("url",url);
  output.src= url;
}

