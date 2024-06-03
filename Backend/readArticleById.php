<?php
require '../Backend/db_connect.php';

if (isset($_GET['id'])) {
    $articleId = $_GET['id'];

    $sql = "SELECT * FROM article WHERE id = $articleId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $article = $result->fetch_assoc();
    } else {
        echo "Artikel nicht gefunden.";
    }
} else {
    echo "Artikel-ID nicht angegeben.";
}

$conn->close();
?>