<?php
ob_start();
?>

<section class="contact">
    <form action="/contact/" method="post">

      <label for="firstName"><i class="fas fa-user-tie"></i></label>
      <input type="text" name="firstName" id="firstName" value="<?php echo old("firstName");?>" placeholder="Prénom">
      <span class="error"><?php echo error("firstName");?></span>

      <label for="lastName"><i class="fas fa-user-tie"></i></label>
      <input type="text" name="lastName" id="lastName" value="<?php echo old("lastName");?>" placeholder="Nom de famille">
      <span class="error"><?php echo error("lastName");?></span>

      <label for="email"><i class="fas fa-envelope"></i></label>
      <input type="email" id="email" name="email" value="<?php echo old("email");?>" placeholder="Email">
      <span class="error"><?php echo error("email");?></span>

      <label for="subject"><i class="fas fa-question"></i></label>
      <input id="subject" type="text" name="subject" value="<?php echo old("subject");?>" placeholder="sujet">
      <span class="error"><?php echo error("subject");?></span>
   
      <label for="message"><i class="fas fa-sticky-note"></i></i></label>
      <textarea name="message" id="message" cols="30" rows="10" placeholder="Message"><?php echo old("message");?></textarea>
      <span class="error"><?php echo error("message");?></span>

    <button type="submit" name="button">S'inscrire</button>
  </form>
</section>

<?php

$content = ob_get_clean();
require VIEWS . 'layout.php';
