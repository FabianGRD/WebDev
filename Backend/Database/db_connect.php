<?php
$servername = "localhost:3306"; // oder die IP-Adresse des Datenbankservers
$username = "root"; // der Benutzername für die Datenbank
$password = ""; // das Passwort für die Datenbank
$dbname = "GamesBlog"; // der Name der Datenbank

// Erstelle die Verbindung
$conn = new mysqli($servername, $username, $password, $dbname);

// Überprüfe die Verbindung
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}
?>
