<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'Simon') {
    die("Zugriff verweigert.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['song_id'])) {
    $chartsFile = '../Charts/charts_data.txt';
    $targetId = $_POST['song_id']; // Das ist jetzt ein String (z.B. 64b1f...)

    if (file_exists($chartsFile)) {
        $lines = file($chartsFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $updatedLines = [];

        foreach ($lines as $line) {
            $parts = explode('|', $line);
            if (count($parts) === 4) {
                $currentId = $parts[0];
                
                // Wenn es der gesuchte Song ist
                if ($currentId === $targetId) {
                    // Falls "Song löschen" geklickt wurde: Diese Zeile einfach überspringen (nicht hinzufügen)
                    if (isset($_POST['action_delete'])) {
                        continue; 
                    }
                    
                    // Falls "Punkte überschreiben" geklickt wurde: Punkte anpassen
                    if (isset($_POST['action_update']) && $_POST['new_votes'] !== '') {
                        $parts[1] = (int)$_POST['new_votes'];
                    }
                }
                
                // Alle verbleibenden oder geänderten Songs sammeln
                $updatedLines[] = implode('|', $parts);
            }
        }

        // Datei komplett aktualisiert abspeichern
        if (!empty($updatedLines)) {
            file_put_contents($chartsFile, implode(PHP_EOL, $updatedLines) . PHP_EOL);
        } else {
            file_put_contents($chartsFile, ""); // Falls alle Songs gelöscht wurden
        }
    }
}

header('Location: adminpannel.php');
exit;
?>