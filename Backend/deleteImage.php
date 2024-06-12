<?php
require 'Database/db_connect.php';

if (isset($_GET['id'])) {
    $articleId = (int)$_GET['id'];
    
    $sqlUpdate = "UPDATE article SET picture=NULL WHERE id=?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("i", $articleId);
    if ($stmtUpdate->execute()) {
        return;
    } else {
        echo "Fehler beim Löschen des Bildes: " . $stmtUpdate->error;
    }
    $stmtUpdate->close();
} else {
    echo "Article ID is missing.";
}

$conn->close();
?>
