<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/newArticle.css">
    <title>Neuen Artikel erstellen</title>
</head>
<body>
    <header>
        <h1>Artikel bearbeiten</h1>
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
    ?>

    <form action="<?=' ../Backend/updateArticleById.php?id=' . $articleId. ' '?>" method="POST">
        <div>
            <label for="title">Titel:</label>
            <input type="text" id="title" name="title" value="<?= htmlspecialchars($article['title']) ?>" required>
        </div>
        <div>
            <label for="shortContent">Kurze Beschreibung:</label>
            <input type="text" id="shortContent" name="shortContent" value="<?= htmlspecialchars($article['shortContent']) ?>" required>
        </div>
        <select id="category" name="category" class="dropdown">
            <option value="<?= htmlspecialchars($article['category']) ?>"><?= htmlspecialchars($article['category']) ?></option>
            <option value="Standard News">Standard News</option>
            <option value="Top News">Top News</option>
            <option value="New Games">New Games</option>
            <option value="Reviews">Reviews</option>
            <option value="Hardware">Hardware</option>
        </select>
        <div>
            <label for="content">Inhalt:</label>
            <textarea id="content" class="content" name="content" rows="10" required><?= htmlspecialchars($article['content']) ?></textarea>
        </div>
        <div>
            <label for="image">Bild hochladen:</label>
            <input type="file" id="image" name="image">
        </div>
        <div>
            <input type="submit" value="Artikel speichern">
        </div>
    </form>

    <?php
    } else {
        echo "Artikel nicht gefunden.";
    }
    ?>
    </div>
</body>
</html>
