<!DOCTYPE html>
<html lang="de">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Games Blog</title>
    <link rel="stylesheet" href="Style/index.css">
</head>
<body>
    <header>
        <h1 class="heading">Games Blog</h1>
        <form action="../Backend/search.php" method="GET">
            <input type="text" name="search" placeholder="Suche nach Titel">
            <input type="submit" value="Suchen">
        </form>
        <a href="newArticle.html" class="new-article-button">Neuen Artikel erstellen</a>
    </header>
    <nav>
        <a href="index.php">Startseite</a>
        <a href="aboutUs.html">Über uns</a>
    </nav>
    <div class="placeholder"></div>
    <img class="banner" src="../Bilder/banner.png" alt="Banner" width="100%">

    <div class="slideshow-container">
        <div class="slide fade">
            <img class="slideElement" src="../Bilder/Slideshow/168838.jpg" alt="Bild 1">
        </div>
        <div class="slide fade">
            <img class="slideElement" src="../Bilder/Slideshow/360_F_599535831_pwQFVG0qtf6ksLXeVTnUwFMvoW5H0WiS.jpg" alt="Bild 2">
        </div>
        <div class="slide fade">
            <img class="slideElement" src="../Bilder/Slideshow/abstract_digital-gamepad-sl-800x450.jpg" alt="Bild 3">
        </div>
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>
    <br>
    <div style="text-align:center">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
    </div>

    <div class="container">
        <div class="post-container">
            <?php
            require '../Backend/readAllArticles.php';
    
            foreach ($articles as $article) {
                echo'<div class="post">';
                echo'<h2>' . htmlspecialchars($article["title"]) . '</h2>';
                echo'<p>' . htmlspecialchars($article["shortContent"]) . '</p>';
                echo '<a href="article.php?id=' . $article["id"] . '">Weiterlesen</a>';
                echo'</div>';
            }
            ?>
        </div>
    </div>

    <script>
        let slideIndex = 1;
        showSlides(slideIndex);
        
        function plusSlides(n) {
          showSlides(slideIndex += n);
        }
        
        function currentSlide(n) {
          showSlides(slideIndex = n);
        }
        
        function showSlides(n) {
          let i;
          let slides = document.getElementsByClassName("slide");
          let dots = document.getElementsByClassName("dot");
          if (n > slides.length) {slideIndex = 1}    
          if (n < 1) {slideIndex = slides.length}
          for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";  
          }
          for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
          }
          slides[slideIndex-1].style.display = "flex";  
          dots[slideIndex-1].className += " active";
        }
    </script>
</body>
</html>
