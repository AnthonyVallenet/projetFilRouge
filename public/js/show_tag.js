var arrow = document.getElementById('arrow');
var tags = document.getElementById('tags');
function rotate() {
    if (arrow.className === 'fas fa-arrow-down rotate') {
        arrow.className = 'fas fa-arrow-down rotate_down';
        tags.style.display = 'none';
    }else{
        arrow.className = 'fas fa-arrow-down rotate';
        tags.style.display = 'block';

    }
}
