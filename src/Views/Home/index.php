<?php
ob_start();
?>

<header class="carousel">

  <div class="mySlides fade">
    <div class="slide1" style="background-image: url('https://image.shutterstock.com/image-photo/bright-spring-view-cameo-island-260nw-1048185397.jpg');">
    </div>
    <div class="textSlide">
      <h1 class="title">Projet Fil Rouge</h1>
      <p class="subtitle">Sous titre 1</p>
    </div>
  </div>

  <div class="mySlides fade">
    <div class="slide2" style="background-image: url('https://image.shutterstock.com/image-photo/bright-spring-view-cameo-island-260nw-1048185397.jpg');">
    </div>
    <div class="textSlide">
      <h1 class="title">Projet Fil Rouge</h1>
      <p class="subtitle">Sous titre 2</p>
    </div>
  </div>

  <div class="mySlides fade ">
    <div class="slide3" style="background-image: url('https://image.shutterstock.com/image-photo/bright-spring-view-cameo-island-260nw-1048185397.jpg');">
    </div>
    <div class="textSlide">
      <h1 class="title">Projet Fil Rouge</h1>
      <p class="subtitle">Sous titre 3</p>
    </div>
  </div>
  
  <div class="arrowPrevSlider">
    <a class="prev" onclick="plusSlides(-1)"><i class="fas fa-chevron-left"></i></a>
  </div>
  <div class="arrowNextSlider">
    <a class="next" onclick="plusSlides(1)"><i class="fas fa-chevron-right"></i></a>
  </div>
</header>

<section class="infoProject sectionContent">
  <div>
    <h2>Quel est ce projet ?</h2>
    <p class="subtitle">Projet éolienne</p>
  </div>
  <div>
    <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
  </div>
</section>

<section class="team sectionContent">
  <div>
    <h2>L'équipe du projet</h2>
    <p class="subtitle">Élève d'EDEN School</p>
  </div>
  <div>

    <div class="blocPeople">
      <div class="people">
        <div style="background-image: url('https://image.shutterstock.com/image-photo/bright-spring-view-cameo-island-260nw-1048185397.jpg');">
        </div>
        <div>
          <p>Test 1</p>
        </div>
      </div>
    </div>

    <div class="blocPeople">
      <div class="people">
        <div style="background-image: url('https://image.shutterstock.com/image-photo/bright-spring-view-cameo-island-260nw-1048185397.jpg');">
        </div>
        <div>
          <p>Test 2</p>
        </div>
      </div>
    </div>

    <div class="blocPeople">
      <div class="people">
        <div style="background-image: url('https://image.shutterstock.com/image-photo/bright-spring-view-cameo-island-260nw-1048185397.jpg');">
        </div>
        <div>
          <p>Test 3</p>
        </div>
      </div>
    </div>

    <div class="blocPeople">
      <div class="people">
        <div style="background-image: url('https://image.shutterstock.com/image-photo/bright-spring-view-cameo-island-260nw-1048185397.jpg');">
        </div>
        <div>
          <p>Test 4</p>
        </div>
      </div>
    </div>

    <div class="blocPeople">
      <div class="people">
        <div style="background-image: url('https://image.shutterstock.com/image-photo/bright-spring-view-cameo-island-260nw-1048185397.jpg');">
        </div>
        <div>
          <p>Test 5</p>
        </div>
      </div>
    </div>
    
  </div>
</section>

<section class="sectionContent test">
</section>

  
  <script>
    var slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
      showSlides(slideIndex += n);
    }

    function currentSlide(n) {
      showSlides(slideIndex = n);
    }

    function showSlides(n) {
      var i;
      var slides = document.getElementsByClassName("mySlides");

      if (n > slides.length) {slideIndex = 1}    
      if (n < 1) {slideIndex = slides.length}
      for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";  
      }
      slides[slideIndex-1].style.display = "block";
    }
  </script>
<?php

$content = ob_get_clean();
require VIEWS . 'layout.php';