<?php
ob_start();
?>

<header class="carousel">

  <div class="mySlides fade">
    <div class="slide1" style="background-image: url('/image/img_code.jpg');">
    </div>
    <div class="textSlide">
      <h1 class="title">Un site pour une éolienne</h1>
      <p class="subtitle">Codé par des élèves!</p>
    </div>
  </div>

  <div class="mySlides fade">
    <div class="slide2" style="background-image: url('/image/eolienne_cassee.jpg');">
    </div>
    <div class="textSlide">
      <h1 class="title">Au final pas d'éolienne...</h1>
      <p class="subtitle">A cause du covid!</p>
    </div>
  </div>

  <div class="mySlides fade ">
    <div class="slide3" style="background-image: url('/image/examen.jpg');">
    </div>
    <div class="textSlide">
      <h1 class="title">L'examen approche !</h1>
      <p class="subtitle">Qui va l'avoir ?</p>
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
    <p>Le projet fil rouge est un projet réalisé tout au long de l'année par les élèves de EDEN School pour promouvoir par le suite la construction d'une petite éolienne capable de recharger un téléphone portable</p>
    </br>
    <p>Suite au récents événements liés aux Covid 19, la création de l'éolienne a été abandonné et les différents groupes se sont focalisés sur la production de leur site qui comporte désormais
    une section article</p>
    </br>

    <p>Retrouvez sur le site du groupe 1 (le meilleur groupe (#^u^#)) les meilleurs articles d'éolienne qui ne nous appartiennent même pas</p>
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
        <div style="background-image: url('/image/team/anthony.jpeg');">
        </div>
        <div>
          <p>Anthony Vallenet</p>
        </div>
      </div>
    </div>

    <div class="blocPeople">
      <div class="people">
        <div style="background-image: url('/image/team/faustin.jpeg');">
        </div>
        <div>
          <p>Faustin Garreau</p>
        </div>
      </div>
    </div>

    <div class="blocPeople">
      <div class="people">
        <div style="background-image: url('/image/team/guerlain.jpeg');">
        </div>
        <div>
          <p>Guerlain Petitmaire</p>
        </div>
      </div>
    </div>
    
  </div>
</section>

<section class="sectionContent articlesCarousel">
<div>
  <h2>Les artciles</h2>
  <p class="subtitle">Présenter par les élèves</p>
</div>

<div>
  

</div>
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