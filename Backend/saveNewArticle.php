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
    
    // Insert data into database
    $sql = "INSERT INTO article (title, shortContent, category, content)
            VALUES ('$title', '$shortContent', '$category', '$content')";

    if ($conn->query($sql) === TRUE) {
        header('Location: ../Frontend/index.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
