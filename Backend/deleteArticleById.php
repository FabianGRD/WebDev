<?php
require 'Database/db_connect.php';

if (isset($_GET['id'])) {
    $articleId = (int)$_GET['id'];

    $sql = "SELECT picture FROM article WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $articleId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $picture = $row['picture'];
    $stmt->close();


    $sql = "DELETE FROM article WHERE id = ?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("i", $articleId);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {

            $sql = "SELECT COUNT(*) AS count FROM article WHERE picture = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $picture);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if ($row['count'] == 0) {
                unlink("../". $picture);
            }

            header("Location: ../index.php");
            exit();
        } else {
            echo "Kein Artikel mit dieser ID gefunden.";
        }
    } else {
        echo "Fehler beim Löschen des Artikels: " . $stmt->error;
    }

    $stmt->close();
} 
$conn->close();
?>