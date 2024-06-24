<!DOCTYPE html>
<html lang="de">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Games Blog</title>
    <link rel="stylesheet" href="Style/index.css">
    <link rel="stylesheet" href="Style/header.css">
</head>
<body>
    <header>
        <h1>Games Blog</h1>
        <form action="index.php?search='<?= isset($_GET['search']) ?>'">
            <input type="text" name="search" id="searchInput" placeholder="Suche nach Titel">
            <input type="submit" class="searchButton" value="Suchen">
        </form>
        <a href="newArticle.php" class="newArticleButton">Neuen Artikel erstellen</a>
    </header>
    <nav>
        <a href="index.php">Startseite</a>
        <a href="aboutUs.html">Über uns</a>
    </nav>
    <div class="placeholder"></div>
    <img class="banner" src="Bilder/banner.png" alt="Banner" width="100%">

    <?php
    $searchQuery = isset($_GET['search']) ? trim($_GET['search']) : '';
    $category = isset($_GET['category']) ? trim($_GET['category']) : 'Alle News';
    

    if (empty($searchQuery)){
        require 'Backend/readAllTopNewsWithPicture.php';
    }
    ?>

    <?php if (!empty($topNews)) : ?>
        <h2 class="topNews">Top News</h2>
        <div class="slideshow-container">
            <?php foreach ($topNews as $news) : ?>
                <div class="slide fade">
                    <img class="slideElement" src="<?= htmlspecialchars($news["picture"]) ?>" alt="News Image">
                    <div class="overlay">
                        <a class="overlay-title" href="article.php?id=<?= htmlspecialchars($news["id"]) ?>"><?= htmlspecialchars($news["title"]) ?></a>
                    </div>
                </div>
            <?php endforeach; ?>
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
        <br>
        <div style="text-align:center">
            <?php
                for ($i = 1; $i <= count($topNews); $i++) {
                    echo '<span class="dot" onclick="currentSlide(' . $i . ')"></span>';
                }
            ?>
        </div>
    <?php endif; ?>


    <?php if (empty($searchQuery)) : ?>
        <form class="container" id="categoryForm" action="index.php" method="GET">
            <select id="filter" name="category" class="filterNews" onchange="submitForm()">
                <option value="Alle News" <?php echo ($category === 'Alle News') ? 'selected' : ''; ?>>Alle News</option>
                <option value="Standard News" <?php echo ($category === 'Standard News') ? 'selected' : ''; ?>>Standard News</option>
                <option value="Top News" <?php echo ($category === 'Top News') ? 'selected' : ''; ?>>Top News</option>
                <option value="New Games" <?php echo ($category === 'New Games') ? 'selected' : ''; ?>>New Games</option>
                <option value="Reviews" <?php echo ($category === 'Reviews') ? 'selected' : ''; ?>>Reviews</option>
                <option value="Hardware" <?php echo ($category === 'Hardware') ? 'selected' : ''; ?>>Hardware</option>
            </select>
        </form>
    <?php endif; ?>

    <div class="container">
        <div class="post-container">
            <?php
            if (empty($searchQuery)){
                if ($category !== 'Alle News') {
                    require 'Backend/getArticlesByCategory.php';
                } else {
                    require 'Backend/readAllArticles.php';
                }

            }else{
                require 'Backend/search.php'; 
            }
    
            foreach ($articles as $article) {
                echo'<div class="post">';
                echo'<h3>' . htmlspecialchars($article["title"]) . '</h3>';
                echo'<span>' . htmlspecialchars($article["shortContent"]) . '</span>';
                echo'<a href="article.php?id=' . $article["id"] . '">Weiterlesen</a>';
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

        function submitForm() {
            document.getElementById('categoryForm').submit();
        }
    </script>
</body>
</html>
