<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel</title>
    <link rel="stylesheet" href="Style/article.css">
</head>
<body>
    <header>
        <h1>Games Blog</h1>
    </header>
    <nav>
        <a href="index.php">Startseite</a>
        <a href="aboutUs.html">Über uns</a>
    </nav>

    <div class="container">
    <?php
    if (isset($_GET['id'])) {
        $articleId = $_GET['id'];
        require '../Backend/readArticleById.php';

        echo '<div class="post">';
        echo '<h2>' . htmlspecialchars($article["title"]) . '</h2>';
        echo '<p>' . nl2br(htmlspecialchars($article["content"])) . '</p>';
        echo '</div>';
    } else {
        echo "Artikel nicht gefunden.";
    }
    ?>
</body>
</html>
