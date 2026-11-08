<?php
// 1. Verbindung zur Datenbank öffnen
$db = new SQLite3('test.db');

// 2. Alle Daten aus der Tabelle 'test' abrufen
$ergebnis = $db->query("SELECT * FROM test");

echo "<h2>Gespeicherte Einträge:</h2>";

// 3. Schleife, die durch alle Zeilen durchgeht und sie ausgibt
while ($zeile = $ergebnis->fetchArray(SQLITE3_ASSOC)) {
    // Hier den Spaltennamen anpassen, den du ausgeben willst (bei dir heißt er vermutlich 'test')
    echo $zeile['test'] . "<br>";
}
?>