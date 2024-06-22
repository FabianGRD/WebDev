<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/newArticle.css">
    <link rel="stylesheet" href="Style/editArticle.css">
    <link rel="stylesheet" href="Style/header.css">
    <title>Artikel bearbeiten</title>
</head>
<body>
    <header>
        <h1>Artikel bearbeiten</h1>
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
    ?>

    <form action="<?=' Backend/updateArticleById.php?id=' . $articleId. ' '?>" method="POST" enctype="multipart/form-data">
        <div>
            <label for="title">Titel:</label>
            <input type="text" id="title" name="title" value="<?= htmlspecialchars($article['title']) ?>" required>
        </div>
        <div>
            <label for="shortContent">Kurze Beschreibung:</label>
            <input type="text" id="shortContent" name="shortContent" value="<?= htmlspecialchars($article['shortContent']) ?>" required>
        </div>
        <div>
            <label for="category">Kategorie:</label>
            <select id="category" name="category" class="dropdown">
                <option value="<?= htmlspecialchars($article['category']) ?>"><?= htmlspecialchars($article['category']) ?></option>
                <option value="Standard News">Standard News</option>
                <option value="Top News">Top News</option>
                <option value="New Games">New Games</option>
                <option value="Reviews">Reviews</option>
                <option value="Hardware">Hardware</option>
            </select>
        </div>
        <div>
            <label for="content">Inhalt:</label>
            <textarea id="content" class="content" name="content" rows="10" required><?= htmlspecialchars($article['content']) ?></textarea>
        </div>
        <div>
            <label for="currentImage">Aktuelles Bild:</label>
            <div class="image-container">
                <?php if (!empty($article['picture'])): ?>
                    <img id="currentImage" src="<?= htmlspecialchars($article['picture']) ?>" alt="Current Image">
                    <a href="#" class="delete-icon" id="deleteIcon" title="Bild löschen">&#128465;</a>
                <?php else: ?>
                    <p>Kein Bild vorhanden</p>
                <?php endif; ?>
            </div>
        </div>
        <div>
            <label for="image">Bild hochladen:</label>
            <input type="file" id="image" name="image" accept="image/png, image/gif, image/jpeg">
        </div>
        <div>
            <input type="hidden" id="imageDeleted" name="imageDeleted" value="0">
            <input type="submit" value="Artikel speichern">
        </div>
    </form>

    <?php
    } else {
        echo "Artikel nicht gefunden.";
    }
    ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteIcon = document.getElementById('deleteIcon');
            const currentImage = document.getElementById('currentImage');
            const imageDeletedInput = document.getElementById('imageDeleted');

            let imageDeleted = false;

            deleteIcon.addEventListener('click', function(event) {
                if (currentImage && !imageDeleted) {
                    currentImage.classList.add('blurred');
                    deleteIcon.classList.add('delete-icon-Active');
                    imageDeletedInput.value = '1';
                    imageDeleted = true;
                }else{
                    currentImage.classList.remove('blurred');
                    deleteIcon.classList.remove('delete-icon-Active');
                    imageDeletedInput.value = '0';
                    imageDeleted = false;
                }
            });
        });
    </script>
</body>
</html>
