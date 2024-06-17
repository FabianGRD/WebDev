<?php
if(isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $_GET['search'];

    require 'Database/db_connect.php';

    $sql = "SELECT id, title, shortContent, category, content FROM article WHERE title LIKE ? OR content LIKE ? OR shortContent LIKE ?";
    $stmt = $conn->prepare($sql);
    $searchTerm = '%' . $search . '%';
    $stmt->bind_param('sss', $searchTerm, $searchTerm, $searchTerm);

    $stmt->execute();
    $result = $stmt->get_result();

    $articles = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $articles[] = $row;
        }
    }

    $stmt->close();
    $conn->close();
} else {
    exit;
}
?>
