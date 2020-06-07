<?php
ob_start();
?>

<section class="sectionRegister">
    <div>
    <h1 class="titre2">Créer votre compte</h1>
    <form action="/register/" method="post">
    <div class="formBlock">
        <div class="block1">
        <div class="firstname">
            <input type="text" class="text-alt" name="firstName" id="firstName" value="<?php echo old("firstName");?>"
                placeholder="Prénom">
                <label for="firstName"><i class="fas fa-user-tie"></i></label>
        </div>
            <?php echo error("firstName") ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("firstName") .'</span>' : ""?>

            <div>
            <input type="text" class="text-alt" name="lastName" id="lastName" value="<?php echo old("lastName");?>"
                placeholder="Nom de famille">
            <label for="lastName"><i class="fas fa-user-tie"></i></label>
            </div>
            <?php echo error("lastName") ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("lastName") .'</span>' : ""?>

            <div>
            <input type="email" id="email" class="text-alt" name="email" value="<?php echo old("email");?>" placeholder="Mail">
            <label for="email"><i class="fas fa-envelope"></i></label>
            </div>
            <?php echo error("email") ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("email") .'</span>' : ""?>
        </div>

        <div class="block2">
            <div>
                <label for="inputPassword"><i class="fas fa-key"></i></label>
                <input id="inputPassword" class="inputPassword text-alt" type="password" name="password"
                    value="<?php echo old("password");?>" placeholder="Mot de passe">
                <button id="btnPassword" class="viewPassword" type="button" name="button"><i
                        class="far fa-eye"></i></button>
            </div>
            <?php echo error("password") ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("password") .'</span>' : ""?>


            <div>
                <label for="inputPasswordConfirm"><i class="fas fa-key"></i></label>
                <input id="inputPasswordConfirm" class="inputPassword text-alt" type="password" name="passwordConfirm"
                    value="<?php echo old("passwordConfirm");?>" placeholder="Confirmation mot de passe">
                <button id="btnPasswordConfirm" class="viewPassword" type="button" name="button"><i
                        class="far fa-eye"></i></button>
            </div>
            <?php echo error("passwordConfirm") ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("passwordConfirm") .'</span>' : ""?>
            <?php echo error("confirm") ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("confirm") .'</span>' : ""?>
        <button class="button" type="submit" name="button">S'inscrire</button>
        </div>
    </div>
       

        <div class="block3">
            <p>Vous avez déjà un compte ? <a href="/login">Connectez vous</a></p>
        </div>
    </form>
    </div>
</section>


<script>
    var btnPass = document.getElementById("btnPassword");
    var inputPass = document.getElementById("inputPassword");
    btnPass.onclick = function () {
        if (inputPass.type === "password") {
            inputPass.type = "text";
        } else {
            inputPass.type = "password";
        }
    };

    var btnPassConf = document.getElementById("btnPasswordConfirm");
    var inputPassConf = document.getElementById("inputPasswordConfirm");
    btnPassConf.onclick = function () {
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