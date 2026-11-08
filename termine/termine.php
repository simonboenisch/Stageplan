<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: loggingIn.html');
    exit;
}
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stageplan - Eventtermine</title>
    <link href="termine.css" rel="stylesheet">
    </link>
</head>

<body>
    <header class="header">
        <div>
            <p class="title">Stageplan</p>
            <p class="subtitle">Eventtermine</p>
        </div>
        <a class="btn-back" href="../navigation.php">Zurück</a>
    </header>

    <main id="displayadd" class="events-container">
        <?php
        // 1. Verbindung zur Datenbank herstellen
        $db = new SQLite3('termine.db');

        // 2. Alle Termine abfragen
        $ergebnis = $db->query("SELECT title, \"date\", \"time\", lehrer FROM termine");

        // Prüfen, ob Daten vorhanden sind, indem wir sie in ein Array laden oder mit einem Zähler arbeiten
        // Da SQLite Query ein Objekt zurückgibt, holen wir uns alle Zeilen in ein PHP-Array:
        $eintraege = [];
        while ($row = $ergebnis->fetchArray(SQLITE3_ASSOC)) {
            $eintraege[] = $row;
        }

        // 3. Prüfen, ob Einträge da sind
        if (count($eintraege) > 0) {
            foreach ($eintraege as $index => $eintrag) {
                // Trennlinie nur einfügen, wenn es nicht der erste Eintrag ist
                if ($index > 0) {
                    echo "<hr class='event-divider'>";
                }

                // Hier kannst du bestimmen, wie Titel, Datum, Uhrzeit und Lehrer in der Card angezeigt werden sollen
                // Beispiel: Titel, Datum um Uhrzeit von Lehrer
                echo "<div class='event-card'>";
                echo "<strong>" . htmlspecialchars($eintrag['title']) . "</strong><br>";
                echo htmlspecialchars($eintrag['date']) . " um " . htmlspecialchars($eintrag['time']) . " Uhr (Lehrer: " . htmlspecialchars($eintrag['lehrer']) . ")";
                echo "</div>";
            }
        } else {
            echo "<p class='no-events'>Noch keine Termine eingetragen.</p>";
        }
        ?>
    </main>

    <footer class="footer">
        <p class="footer-title">Neuer Eintrag:</p>
    </footer>

    <form action="termineadd.php" method="post">
        <div class="form-container">
            <input id="title" type="text" placeholder="Titel" class="form-input form-input-full" name="title">

            <div class="input-row">
                <input id="date" type="date" class="form-input" name="date">
                <input id="time" type="time" class="form-input" name="time">
                <input id="teacher" type="text" class="form-input" placeholder="Lehrer" name="teacher">
            </div>

            <button class="btn-submit" type="submit">
                <b>Senden</b>
            </button>
        </div>
    </form>

    <form action="deletTermin.php" method="POST" style="margin: 1rem; border-top: 1px solid gray; padding-top: 1rem;">
        <label for="name">Termin löschen:</label>
        <input type="text" name="name" class="form-input" style="margin-bottom: 1rem;" placeholder="Titel des Termins">
        <input type="submit" class="btn-submit">
    </form>
</body>

</html>