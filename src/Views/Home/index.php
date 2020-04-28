<?php
ob_start();
?>
    <p>Home</p>
<?php

$content = ob_get_clean();
require VIEWS . 'layout.php';