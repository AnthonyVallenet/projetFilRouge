<?php
ob_start();
?>

<section id="register">
    <h1>Créer un compte</h1>
    <form action="/register/" method="post">
        
        <input type="text" name="firstName" id="firstName" value="<?php echo old("firstName");?>" placeholder="Prénom">
        <label for="firstName"><i class="fas fa-user-tie"></i></label>     
        <?php echo error("firstName") ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("firstName") .'</span>' : ""?>

        <input type="text" name="lastName" id="lastName" value="<?php echo old("lastName");?>" placeholder="Nom de famille">
        <label for="lastName"><i class="fas fa-user-tie"></i></label> 
        <?php echo error("lastName") ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("lastName") .'</span>' : ""?>

        <input type="email" id="email" name="email" value="<?php echo old("email");?>" placeholder="Mail">
        <label for="email"><i class="fas fa-envelope"></i></label>
        <?php echo error("email") ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("email") .'</span>' : ""?>
            
        <label for="inputPassword"><i class="fas fa-key"></i></label>
        <input id="inputPassword" class="inputPassword" type="password" name="password" value="<?php echo old("password");?>" placeholder="Mot de passe">
        <button id="btnPassword" class="viewPassword" type="button" name="button"><i class="far fa-eye"></i></button>
        <?php echo error("password") ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("password") .'</span>' : ""?>

        <label for="inputPasswordConfirm"><i class="fas fa-key"></i></label>
        <input id="inputPasswordConfirm" class="inputPassword" type="password" name="passwordConfirm" value="<?php echo old("passwordConfirm");?>" placeholder="Confirmation mot de passe">
        <button id="btnPasswordConfirm" class="viewPassword" type="button" name="button"><i class="far fa-eye"></i></button>
        <?php echo error("passwordConfirm") ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("passwordConfirm") .'</span>' : ""?>
        <?php echo error("confirm") ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("confirm") .'</span>' : ""?>


        <button type="submit" name="button">S'inscrire</button>
        <p>Vous avez déjà un compte ? <a href="/login">Connectez vous</a></p>
    </form>

</section>


<script>
var btnPass = document.getElementById("btnPassword");
var inputPass = document.getElementById("inputPassword");
btnPass.onclick = function() {
    if (inputPass.type === "password") {
        inputPass.type = "text";
    } else {
        inputPass.type = "password";
    }
};

var btnPassConf = document.getElementById("btnPasswordConfirm");
var inputPassConf = document.getElementById("inputPasswordConfirm");
btnPassConf.onclick = function() {
    if (inputPassConf.type === "password") {
        inputPassConf.type = "text";
    } else {
        inputPassConf.type = "password";
    }
};
</script>

<?php

$content = ob_get_clean();
require VIEWS . 'layout.php';
