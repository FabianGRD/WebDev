<?php

// Einbinden der Datenbankverbindung
require 'Database/db_connect.php';

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all articles
$sql = "SELECT id, title, shortContent, category, content FROM article";
$result = $conn->query($sql);

$articles = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $articles[] = $row;
    }
} else {
    echo "No articles found.";
}

$conn->close();
?>
