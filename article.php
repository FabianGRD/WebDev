<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel</title>
    <link rel="stylesheet" href="Style/article.css">
    <link rel="stylesheet" href="Style/header.css">
</head>
<body>
    <header>
        <h1>Artikel</h1>
    </header>
    <nav>
        <a href="index.php">Startseite</a>
        <a href="aboutUs.html">Über uns</a>
    </nav>
    <div class="placeholder"></div>
    <div class="container">
    <?php
        if (isset($_GET['id'])) {
            $articleId = $_GET['id'];
            require 'Backend/readArticleById.php';

            echo '<div class="post">';
            echo '<div class="article-buttons">';
            echo '<form method="POST" action="Backend/deleteArticleById.php?id=' . $articleId. '" onsubmit="return confirm(\'Sind Sie sicher, dass Sie diesen Artikel löschen möchten?\');">';
            echo '<button class="deleteButton" type="submit">Löschen</button>';
            echo '</form>';
            echo '<form method="POST" action="editArticle.php?id=' . $articleId. '">';
            echo '<button class="editButton" type="submit">Bearbeiten</button>';
            echo '</form>';
            echo '</div>';
            echo '<h2>' . htmlspecialchars($article["title"]) . '</h2>';
            
            if (!empty($article["picture"])) {
                echo '<div class="article-picture">';
                echo '<img src="' . htmlspecialchars($article["picture"]) . '" alt="Article Image">';
                echo '</div>';
            }

            echo '<p>' . nl2br(htmlspecialchars($article["content"])) . '</p>';
            echo '</div>';
        } else {
            echo "Artikel nicht gefunden.";
        }
    ?>
</body>
</html>
