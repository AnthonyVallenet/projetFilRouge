<?php
ob_start();
?>

<section id="login">
    <h1>Se connecter</h1>
    <form action="/login/" method="post">

        <label for="email">Email :</label>
        <input type="text" name="email" id="email" value="<?php echo old("email");?>" placeholder="email">
        <?php echo error("email") ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("email") .'</span>' : ""?>

        <label for="password">Mot de passe :</label>
        <input id="inputPassword" type="password" id="password" name="password" value="<?php echo old("password");?>" placeholder="password">
        <button id="btnPassword" type="button" name="button"><i class="far fa-eye"></i></button>
        <?php echo error("password") ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("password") .'</span>' : ""?>

        <span class="error"><?php echo error("message");?></span>

        <button type="submit" class="button" name="button">S'identifier</button>
        <p>Vous n'avez pas de compte ? <a href="/register">Inscrivez vous !</a></p>

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
</script>

<?php

$content = ob_get_clean();
require VIEWS . 'layout.php';
