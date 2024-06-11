<?php
require 'Database/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_GET['id'])) {
        $articleId = (int)$_GET['id'];
        $title = $_POST['title'];
        $shortContent = $_POST['shortContent'];
        $category = $_POST['category'];
        $content = $_POST['content'];
        
        $sql = "UPDATE article SET title=?, shortContent=?, category=?, content=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $title, $shortContent, $category, $content, $articleId);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                header("Location: ../Frontend/index.php");
                exit();
            } else {
                echo "Kein Artikel mit dieser ID gefunden.";
            }
        } else {
            echo "Fehler beim updaten des Artikels: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Article ID is missing.";
    }
} else {
    echo "Invalid request method.";
}

$conn->close();
?>
