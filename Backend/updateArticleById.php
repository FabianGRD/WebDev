<?php
require 'Database/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_GET['id'])) {
        $articleId = (int)$_GET['id'];
        $title = $_POST['title'];
        $shortContent = $_POST['shortContent'];
        $category = $_POST['category'];
        $content = $_POST['content'];
        $imageUrl = null;
        $imageDeleted = $_POST['imageDeleted'];

        // If a new image is uploaded, handle the file upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $targetDir = "../uploads/";
            $targetFile = $targetDir . basename($_FILES['image']['name']);

            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                $imageUrl =  "uploads/". basename($_FILES['image']['name']);
            } else {
                echo "Error uploading file.";
                exit();
            }
        }

        if ($imageDeleted == true) {
            require '../Backend/deleteImage.php';
        }

        if ($imageUrl) {
            $sql = "UPDATE article SET title=?, shortContent=?, category=?, content=?, picture=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssi", $title, $shortContent, $category, $content, $imageUrl, $articleId);
        } else {
            $sql = "UPDATE article SET title=?, shortContent=?, category=?, content=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssi", $title, $shortContent, $category, $content, $articleId);
        }

        if ($stmt->execute()) {
            header("Location: ../index.php");
            exit();
        } else {
            echo "Fehler beim Updaten des Artikels: " . $stmt->error;
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
