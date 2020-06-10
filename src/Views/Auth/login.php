<?php
ob_start();
?>

<section class="sectionLogin">
    <div>
        <div class="bandeau">
            <div id='title'>
                <h1 class="titre1">Se connecter</h1>
            </div>
        </div>
        <form action="/login/" method="post">
            <div class="principalBlock">

                <div class="emailLogin">
                    <label for="email"></label>
                    <input type="text" name="email" id="email" value="<?php echo old("email");?>" placeholder="email">
                    <?php echo error("email") ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("email") .'</span>' : ""?>
                </div>


                <div class="passwordLogin">
                    <div>
                        <label for="password"></label>
                        <input id="inputPassword" type="password" id="password" name="password"
                            value="<?php echo old("password");?>" placeholder="password">
                        <button id="btnPassword" type="button" name="button"><i class="far fa-eye"></i></button>
                    </div>
                    <?php echo error("password") ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("password") .'</span>' : ""?>
                </div>
                <div class="connectedButton">
                    <button type="submit" class="button" name="button">S'identifier</button>
                </div>
            </div>
        </form>

        <div class="blockConnected">
            <p class="connected text-alt">Vous n'avez pas de compte ? <a href="/register">Inscrivez vous !</a></p>
        </div>
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
</script>

<?php

$content = ob_get_clean();
require VIEWS . 'layout.php';