<?php
require 'Database/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $conn->real_escape_string($_POST['title']);
    $shortContent = $conn->real_escape_string($_POST['shortContent']);
    $category = $conn->real_escape_string($_POST['category']);
    $content = $conn->real_escape_string($_POST['content']);
    $imageUrl = null;

    echo'test';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDir = "../uploads/";
        // if (!is_dir($targetDir)) {
        //     mkdir($targetDir, 0777, true);
        // }
        
        $targetFile = $targetDir . basename($_FILES['image']['name']);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $imageUrl = $targetFile;
        } else {
            echo "Error uploading file.";
            exit();
        }
    }

    $sql = "INSERT INTO article (title, shortContent, category, content, picture)
            VALUES ('$title', '$shortContent', '$category', '$content', '$imageUrl')";

    if ($conn->query($sql) === TRUE) {
        header('Location: ../Frontend/index.php');
        echo "". htmlspecialchars( basename( $_FILES["image"]["name"])) .
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
