<?php
require 'Database/db_connect.php';

if (isset($_GET['id'])) {
    $articleId = (int)$_GET['id'];
    
    $sqlUpdate = "UPDATE article SET picture=NULL WHERE id=?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("i", $articleId);
    if ($stmtUpdate->execute()) {
        return;
    }
    
    $stmtUpdate->close();
}

$conn->close();
?>
