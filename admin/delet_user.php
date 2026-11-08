<?php
$username = $_POST['username'];

if(isset($_POST['check'])){
    $filename = "../stageplan_user_accounts.db";
    
    // 1. Überprüfen, ob die Datei existiert
    if (file_exists($filename)) {
        // Liest die Datei Zeile für Zeile in ein Array
        $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $newLines = [];
        $userDeleted = false;

        // 2. Zeilen durchgehen und den Benutzer suchen
        foreach ($lines as $line) {
            // Teilt die Zeile am Trennzeichen '|' auf
            $parts = explode('|', $line);
            
            // Wenn der Name übereinstimmt, überspringen wir diese Zeile (löschen sie)
            if ($parts[0] === $username) {
                $userDeleted = true;
                continue; 
            }
            
            // Alle anderen Benutzer behalten wir
            $newLines[] = $line;
        }

        // 3. Wenn gelöscht wurde, Datei neu schreiben
        if ($userDeleted) {
            // Verbindet die Zeilen wieder mit einem Zeilenumbruch
            file_put_contents($filename, implode(PHP_EOL, $newLines) . PHP_EOL);
            echo "<p>Benutzer <strong>" . htmlspecialchars($username) . "</strong> wurde erfolgreich gelöscht.</p>";
        } else {
            echo "<p>Benutzer nicht gefunden.</p>";
        }
    } else {
        echo "<p>Fehler: Die Benutzerdatenbank wurde nicht gefunden.</p>";
    }

} else {
    echo "<p>Bitte betaetige die Loeschung!</p>";
}
?>