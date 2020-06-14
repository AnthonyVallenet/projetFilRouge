<?php
ob_start();
?>

<script src="https://kit.fontawesome.com/51cdbc8526.js" crossorigin="anonymous"></script>

<div class="bandeau">
  <div id="title">
    <h1 class="titre1">Contact</h1>
  </div>
</div>

<section class="sectionContact">
  <!-- informations -->
  <div class="first">
    <h2 class="second-titre titre2">Informations</h2>
    <div class="contact-info">
      <div>
        <p class="text">Direction :</p>
        <ul class="text-alt">
          <li>Monsieur Pierre Maillet, Fondateur</li>
          <li>Madame Ségolène de Montgolfier, Fondatrice</li>
          <li>Madame Hélène Ribeiro, Fondatrice</li>
        </ul>
      </div>

      <div class="text">
        <p>tel: 09 81 78 68 85</p>
      </div>

      <div class="text">
        <p>contact@edenschool.fr</p>
      </div>

      <div>
        <p class="text">Cours de la République</p>
        <p class="text-alt">69100 VILLEURBANE</p>
      </div>

      <div class="contact-icon">
        <a href="https://www.facebook.com/edenschool.fr" target="blank"><i class="fab fa-facebook-square facebook"></i></a>

        <a href="https://twitter.com/edenschool_FR" target="blank"><i class="fab fa-twitter-square twitter"></i></a>

        <a href="https://www.linkedin.com/company/eden-school-france/" target="blank"><i class="fab fa-linkedin linkedin"></i></a>
      </div>
    </div>
  </div>
  <!-- informations -->
<!-- formulaire -->
  <div>
    <h2 class="second-titre titre2">Contact</h2>
    <form action="/contact/" method="post">
      <div class="prenom-nom">
        <div>
          <label for="lastName">Nom:</label>
          <input type="text" class="text-alt" name="lastName" id="lastName" value="<?php echo old("lastName");?>"
            placeholder="Nom">
          <span class="error"><?php echo error("lastName");?></span>
        </div>

        <div>
          <label for="firstName">Prenom:</label>
          <input type="text" class="text-alt" name="firstName" id="firstName" value="<?php echo old("firstName");?>"
            placeholder="Prenom">
          <span class="error"><?php echo error("firstName");?></span>
        </div>
      </div>

      <div>
        <label for="email">Email:</label>
        <input type="email" class="text-alt" id="email" name="email" value="<?php echo old("email");?>"
          placeholder="Email">
        <span class="error"><?php echo error("email");?></span>
      </div>

      <div>
        <label for="subject">Sujet:</label>
        <input id="subject" class="text-alt" type="text" name="subject" value="<?php echo old("subject");?>"
          placeholder="Sujet">
        <span class="error"><?php echo error("subject");?></span>
      </div>

      <div>
        <label for="message">Message:</label>
        <textarea name="message" id="message" cols="30" rows="10"
          placeholder="Message"><?php echo old("message");?></textarea>
        <span class="error"><?php echo error("message");?></span>
      </div>

      <div>
        <button class="button send-button" type="submit" name="button">Submit</button>
      </div>
    </form>
  </div>
  <!-- formulaire -->
</section>

<?php

$content = ob_get_clean();
require VIEWS . 'layout.php';