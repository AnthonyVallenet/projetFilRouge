// récupère la fleche
var arrow = document.getElementById('arrow');
// récupère les tags
var tags = document.getElementById('tags');
// Change le  style de la fleche et des tags pour avoir une animation
function rotate() {
    if (arrow.className === 'fas fa-arrow-down rotate') {
        arrow.className = 'fas fa-arrow-down rotate_down';
        tags.style.height = "0px";
        tags.style. padding = "0px";
        tags.style.transitionDuration = "0.3s";

    }else{
        arrow.className = 'fas fa-arrow-down rotate';
        tags.style.height = '80px';
        tags.style.transitionDuration = "0.3s";
        tags.style. padding = "5px 10px";
    }
}
