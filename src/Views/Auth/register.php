<?php
ob_start();
?>

<section class="sectionRegister">
    <div>
        <div class="bandeau">
            <div id='title'>
                <h1 class="titre1">Créer votre compte</h1>
            </div>
        </div>
        <form action="/register/" method="post">
            <div class="formBlock">
                <div class="allblock">
                    <div class="block1">
                        <div class="firstname">
                            <div>
                                <input type="text" class="text" name="firstName" id="firstName"
                                    value="<?php echo old("firstName");?>" placeholder="Prénom">
                                <label for="firstName"><i class="fas fa-user-tie"></i></label>
                            </div>
                            <?php echo error("firstName") ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("firstName") .'</span>' : ""?>
                        </div>
                        <div class="lastname">
                            <div>
                                <input type="text" class="text" name="lastName" id="lastName"
                                    value="<?php echo old("lastName");?>" placeholder="Nom de famille">
                                <label for="lastName"><i class="fas fa-user-tie"></i></label>
                            </div>
                            <?php echo error("lastName") ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("lastName") .'</span>' : ""?>
                        </div>


                        <div class="email">
                            <div>
                                <input type="email" id="email" class="text" name="email"
                                    value="<?php echo old("email");?>" placeholder="Mail">
                                <label for="email"><i class="fas fa-envelope"></i></label>
                            </div>
                            <?php echo error("email") ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("email") .'</span>' : ""?>
                        </div>
                    </div>


                    <div class="block2">
                        <div class="secondblock">
                            <div>
                                <label class="key" for="inputPassword"><i class="fas fa-key"></i></label>
                                <input id="inputPassword" class="inputPassword text" type="password" name="password"
                                    value="<?php echo old("password");?>" placeholder="Mot de passe">
                                <button id="btnPassword" class="viewPassword" type="button" name="button"><i
                                        class="far fa-eye"></i></button>
                            </div>
                            <?php echo error("password") ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("password") .'</span>' : ""?>
                        </div>



                        <div class="passwordconfirm">
                            <div>
                                <label class="key" for="inputPasswordConfirm"><i class="fas fa-key"></i></label>

                                <input id="inputPasswordConfirm" class="inputPassword text" type="password"
                                    name="passwordConfirm" value="<?php echo old("passwordConfirm");?>"
                                    placeholder="Confirmation mot de passe">
                                <button id="btnPasswordConfirm" class="viewPassword" type="button" name="button"><i
                                        class="far fa-eye"></i></button>
                            </div>

                            <?php echo error("passwordConfirm") ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("passwordConfirm") .'</span>' : ""?>
                            <?php echo error("confirm") ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("confirm") .'</span>' : ""?>
                        </div>

                        <div id="button">
                            <button class="button" type="submit" name="button">S'inscrire</button>
                        </div>
                    </div>
                </div>
                <div class="block3">
                    <p class="text-alt">Vous avez déjà un compte ? <a class="connect" href="/login">Connectez vous</a>
                    </p>
                </div>

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