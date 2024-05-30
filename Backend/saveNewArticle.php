<?php
// Einbinden der Datenbankverbindung
require 'Database/db_connect.php';
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $title = $conn->real_escape_string($_POST['title']);
    $shortContent = $conn->real_escape_string($_POST['shortContent']);
    $category = $conn->real_escape_string($_POST['category']);
    $content = $conn->real_escape_string($_POST['content']);

    // Handle file upload
    $image = NULL;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check file size (optional)
        if ($_FILES["image"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            exit();
        }

        // Allow certain file formats (optional)
        $allowedFormats = ["jpg", "png", "jpeg", "gif"];
        if (!in_array($imageFileType, $allowedFormats)) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            exit();
        }

        // Move file to target directory
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $image = $conn->real_escape_string($targetFile);
        } else {
            echo "Sorry, there was an error uploading your file.";
            exit();
        }
    }

    // Insert data into database
    $sql = "INSERT INTO article (title, shortContent, category, content, image)
            VALUES ('$title', '$shortContent', '$category', '$content', '$image')";

    if ($conn->query($sql) === TRUE) {
        echo "New article created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
