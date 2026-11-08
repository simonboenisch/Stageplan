<?php
// Sicherstellen, dass die Anfrage per POST kam und der Index existiert
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['zeilen_index'])) {
    
    $datei = 'banned_users.txt'; // Da wir uns im Ordner /bann/ befinden
    $indexZuLoeschen = (int)$_POST['zeilen_index'];

    if (file_exists($datei)) {
        // Datei in ein Array einlesen
        $zeilen = file($datei, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        // Prüfen, ob die Zeile im Array existiert
        if (isset($zeilen[$indexZuLoeschen])) {
            // Die entsprechende Zeile löschen
            unset($zeilen[$indexZuLoeschen]);

            // Das Array neu abspeichern (implode fügt die Zeilen wieder mit einem Zeilenumbruch zusammen)
            // Falls die Datei danach komplett leer ist, schreiben wir einen leeren String rein
            $neuerInhalt = !empty($zeilen) ? implode("\n", $zeilen) . "\n" : "";
            file_put_contents($datei, $neuerInhalt);
        }
    }
}

// Nach dem Entbannen automatisch zurück zum Admin-Panel leiten
header("Location: ../admin/adminpannel.php");
exit;
?>