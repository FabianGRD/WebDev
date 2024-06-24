<?php
require 'Database/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $conn->real_escape_string($_POST['title']);
    $shortContent = $conn->real_escape_string($_POST['shortContent']);
    $category = $conn->real_escape_string($_POST['category']);
    $content = $conn->real_escape_string($_POST['content']);
    $imageUrl = null;

    $targetDir = "../uploads/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    if (!in_array($imageFileType, ["jpg", "jpeg", "png"])) {
        header("Location: ../newArticle.php?error=" . urlencode("Article wasn't saved. File upload failed. Only JPG, JPEG & PNG files are allowed."));
        exit();
    }

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $imageUrl = "uploads/" . basename($_FILES['image']['name']);
        } else {
            header("Location: ../newArticle.php?error=" . urlencode("Error uploading file."));
            exit();
        }
    }

    $sql = "INSERT INTO article (title, shortContent, category, content, picture)
            VALUES ('$title', '$shortContent', '$category', '$content', '$imageUrl')";

    if ($conn->query($sql) === TRUE) {
        header('Location: ../index.php');
        $conn->close();
        exit();
    } else {
        header("Location: ../newArticle.php?error=" . urlencode("Error: " . $sql . "<br>" . $conn->error));
        $conn->close();
        exit();
    }
}
?>
