<?php
ob_start();

?>

<section class="sectionPage sectionPNF">
    <div>
        <a href="/"><i class="fas fa-arrow-left"></i></a>
        <span>Retour à l'accueil</span>
    </div>
    
    <div>
        <a href="/"><h1>Oups !</h1></a>
        <div>
            <p>La page que vous cherchez est introuvable !</p>
            <p>Erreur 404 - <a href="/">Revenir à l'accueil !</a></p>
        </div>
    </div>
    
</section>

<?php

$content = ob_get_clean();
require VIEWS . 'layout.php';
