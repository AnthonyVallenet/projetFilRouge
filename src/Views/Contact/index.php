<?php
ob_start();
?>

<script src="https://kit.fontawesome.com/51cdbc8526.js" crossorigin="anonymous"></script>

<div id="bandeau">
  <div class="header">
    <h1>Contact</h1>
  </div>
</div>


<section class="main-contact">
  <div class="first">
    <h2 class="second-titre">Informations</h2>
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
        <a><i id="facebook" class="fab fa-facebook-square"></i></a>

        <a><i id="twitter" class="fab fa-twitter-square"></i></a>

        <a><i id="linkedin" class="fab fa-linkedin"></i></a>


      </div>
    </div>
  </div>
  <div>



    <h2 class="second-titre">Contact</h2>
    <form action="/contact/" method="post">
      <div class="prenom-nom">
        <div class="prenom">
          <label for="lastName">Nom:</label>
          <input type="text" class="text-alt" name="lastName" id="lastName" value="<?php echo old("lastName");?>"
            placeholder="Nom">
          <span class="error"><?php echo error("lastName");?></span>
        </div>

        <div class="nom">
          <label for="firstName">Prenom:</label>
          <input type="text" class="text-alt" name="firstName" id="firstName" value="<?php echo old("firstName");?>"
            placeholder="Prenom">
          <span class="error"><?php echo error("firstName");?></span>
        </div>
      </div>

      <div class="email">
        <label for="email">Email:</label>
        <input type="email" class="text-alt" id="email" name="email" value="<?php echo old("email");?>" placeholder="Email">
        <span class="error"><?php echo error("email");?></span>
      </div>

      <div class="sujet">
        <label for="sujet">Sujet:</label>
        <input id="sujet" class="text-alt" type="text" name="sujet" value="<?php echo old("sujet");?>" placeholder="Sujet">
        <span class="error"><?php echo error("sujet");?></span>
      </div>

      <div class="message">
        <label for="message">Message:</label>
        <textarea name="message" id="message" cols="30" rows="10"
          placeholder="Message"><?php echo old("message");?></textarea>
        <span class="error"><?php echo error("message");?></span>
      </div>

      <div class="send">
        <button class="button send-button" type="submit" name="button">Submit</button>
      </div>
    </form>
  </div>
</section>

<?php

$content = ob_get_clean();
require VIEWS . 'layout.php';