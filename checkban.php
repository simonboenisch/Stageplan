<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: loggingIn.html');
    exit;
}

$user = $_SESSION['user'];
$datei = 'bann/banned_users.txt'; 

if (file_exists($datei)) {
    $zeilen = file($datei, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($zeilen as $zeile) {
        $teile = explode('|', $zeile);
        $gesperrter_name = trim($teile[0]);

        // Wenn der Name in der Liste gefunden wird
        if ($gesperrter_name === $user) {
            // Grund auslesen (falls keiner da ist, Standardtext setzen)
            $grund = isset($teile[1]) ? trim($teile[1]) : 'Kein Grund angegeben';
            
            // Alle alten Session-Inhalte löschen...
            $_SESSION = array();
            
            // ...aber den Grund für die nächste Seite neu einspeichern
            $_SESSION['grund'] = $grund;
            
            // Weiterleitung zur Sperrseite
            header("Location: du_wurdest_gesperrt.php");
            exit;
        }
    }
}

// Wenn der Nutzer nicht gesperrt ist
header("Location: navigation.php");
exit;
?>
?>
