<?php
    $category = $_GET['category'];
    require 'Database/db_connect.php';

    $sql = "SELECT id, title, shortContent, category, content FROM article WHERE category = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $category);

    $stmt->execute();
    $result = $stmt->get_result();

    $articles = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $articles[] = $row;
        }
    }

    $stmt->close();
    $conn->close();
?>
