<?php
require 'Database/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $conn->real_escape_string($_POST['title']);
    $shortContent = $conn->real_escape_string($_POST['shortContent']);
    $category = $conn->real_escape_string($_POST['category']);
    $content = $conn->real_escape_string($_POST['content']);
    $image = null;

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = file_get_contents($_FILES['image']['tmp_name']);
    }

    $sql = "INSERT INTO article (title, shortContent, category, content, picture)
            VALUES ('$title', '$shortContent', '$category', '$content', '$image')";

    if ($conn->query($sql) === TRUE) {
        header('Location: ../Frontend/index.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
