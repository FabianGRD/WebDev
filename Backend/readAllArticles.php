<?php

require 'Database/db_connect.php';

$sql = "SELECT id, title, shortContent, category FROM article ORDER By id DESC";
$result = $conn->query($sql);

$articles = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $articles[] = $row;
    }
}

$conn->close();
?>
