<?php
ob_start();
?>

<header class="carousel">

  <div class="mySlides fade">
    <div class="slide1" style="background-image: url('https://image.shutterstock.com/image-photo/bright-spring-view-cameo-island-260nw-1048185397.jpg');">
    </div>
    <div class="textSlide">
      <p class="title">Titre 1</p>
      <p class="subtitle">Sous titre</p>
    </div>
  </div>

  <div class="mySlides fade">
    <div class="slide2" style="background-image: url('https://image.shutterstock.com/image-photo/bright-spring-view-cameo-island-260nw-1048185397.jpg');">
    </div>
    <div class="textSlide">
      <p class="title">Titre 2</p>
      <p class="subtitle">Sous titre</p>
    </div>
  </div>

  <div class="mySlides fade ">
    <div class="slide3" style="background-image: url('https://image.shutterstock.com/image-photo/bright-spring-view-cameo-island-260nw-1048185397.jpg');">
    </div>
    <div class="textSlide">
      <p class="title">Titre 3</p>
      <p class="subtitle">Sous titre</p>
    </div>
  </div>
  
  <a class="prev" onclick="plusSlides(-1)"><i class="fas fa-chevron-left"></i></a>
  <a class="next" onclick="plusSlides(1)"><i class="fas fa-chevron-right"></i></a>

</header>

  
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