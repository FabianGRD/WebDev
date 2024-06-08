<?php
require 'Database/db_connect.php';

if (isset($_GET['id'])) {
    $articleId = (int)$_GET['id'];

    $sql = "SELECT * FROM article WHERE id = $articleId";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $article = $result->fetch_assoc();
    } else {
        echo "Artikel nicht gefunden.";
    }
} else {
    echo "Artikel-ID nicht angegeben.";
}

$conn->close();
?>