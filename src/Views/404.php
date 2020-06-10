<?php
ob_start();

?>

<section class="secError">
    <div>
        <h1 class="error">Erreur 404</h1>
        <p>La page rechercher n'existe pas ! <a href="/">Quitter cette page !</a></p>
    </div>
</section>

<?php

$content = ob_get_clean();
require VIEWS . 'layout.php';
