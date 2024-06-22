<?php

require 'Database/db_connect.php';

$sql = "SELECT * FROM article WHERE category = 'Top News' and picture IS NOT null ORDER BY id DESC";
$result = $conn->query($sql);

$topNews = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $topNews[] = $row;
    }
}

$conn->close();
?>
