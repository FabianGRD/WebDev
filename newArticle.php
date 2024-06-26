<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/newArticle.css">
    <link rel="stylesheet" href="Style/header.css">
    <title>Neuen Artikel erstellen</title>
</head>
<body>
    <header>
        <h1>Neuen Artikel erstellen</h1>
    </header>
    <nav>
        <a href="index.php">Startseite</a>
        <a href="aboutUs.html">Über uns</a>
    </nav>
    <div class="placeholder"></div>
    <div class="container">
        <form action="Backend/saveNewArticle.php" method="POST" enctype="multipart/form-data">
            <div>
                <label for="title">Titel:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div>
                <label for="shortContent">Kurze Beschreibung:</label>
                <input type="text" id="shortContent" name="shortContent" required>
            </div>
            <div>
                <label for="category">Kategorie:</label>
                <select id="category" name="category" class="dropdown">
                    <option>Standard News</option>
                    <option>Top News</option>
                    <option>New Games</option>
                    <option>Reviews</option>
                    <option>Hardware</option>
                </select>
            </div>
            <div>
                <label for="content">Inhalt:</label>
                <textarea id="content" class="content" name="content" rows="10" required></textarea>
            </div>
            <div>
                <label for="image">Bild hochladen:</label>
                <input type="file" id="image" name="image" accept="image/png, image/jpeg">
                <?php
                if (isset($_GET['error'])) {
                    echo '<div class="errorMessage">'. htmlspecialchars($_GET['error']) . "</div>";
                }
                ?>
            </div>
            <div>
                <input type="submit" value="Artikel erstellen">
            </div>
        </form>
    </div>
</body>
</html>
