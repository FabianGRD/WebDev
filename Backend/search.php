<?php
// Überprüfen, ob das Suchfeld gesetzt ist
if(isset($_GET['search'])) {
    // Wert des Suchfelds erhalten
    $search = $_GET['search'];

    // Hier kommt deine Suchlogik
    // Zum Beispiel könntest du eine Datenbankabfrage durchführen
    // und die entsprechenden Ergebnisse anzeigen

    // Für dieses Beispiel geben wir nur den Suchbegriff aus
    echo "Du hast nach dem Titel '$search' gesucht.";
} else {
    // Wenn das Suchfeld nicht gesetzt ist, eine Fehlermeldung ausgeben
    echo "Es wurde kein Suchbegriff eingegeben.";
}
?>
