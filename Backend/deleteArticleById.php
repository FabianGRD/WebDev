<?php
require 'Database/db_connect.php';

if (isset($_GET['id'])) {
    $articleId = (int)$_GET['id'];

    $sql = "DELETE FROM article WHERE id = ?";
    $stmt = $conn->prepare($sql);

    echo" test";
    $stmt->bind_param("i", $articleId);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            header("Location: ../Frontend/index.php");
            exit();
        } else {
            echo "Kein Artikel mit dieser ID gefunden.";
        }
    } else {
        echo "Fehler beim Löschen des Artikels: " . $stmt->error;
    }

    $stmt->close();
} 
$conn->close();
?>