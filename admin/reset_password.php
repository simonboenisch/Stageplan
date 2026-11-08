<?php
$user = $_POST['user'];
$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];

if($pass1 == $pass2){
    $filename = "../stageplan_user_accounts.db";
    
    if (file_exists($filename)) {
        // Datei zeilenweise in ein Array laden
        $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $newLines = [];
        $userFound = false;

        // Neues Passwort hashen (passend zu deinen bestehenden SHA-1 Hashes)
        $newHash = sha1($pass1);

        foreach ($lines as $line) {
            $parts = explode('|', $line);
            
            // Wenn der Benutzername übereinstimmt, ändern wir das Passwort
            if ($parts[0] === $user) {
                $newLines[] = $user . '|' . $newHash;
                $userFound = true;
            } else {
                // Alle anderen Zeilen bleiben unverändert
                $newLines[] = $line;
            }
        }

        if ($userFound) {
            // Datei mit den aktualisierten Daten überschreiben
            file_put_contents($filename, implode(PHP_EOL, $newLines) . PHP_EOL);
            echo "Das Passwort für den Benutzer <strong>" . htmlspecialchars($user) . "</strong> wurde erfolgreich geändert.";
        } else {
            echo "Benutzer nicht gefunden.";
        }
    } else {
        echo "Fehler: Die Benutzerdatenbank wurde nicht gefunden.";
    }

} else {
    echo "Die Passwoerter stimmen nicht ueberein!";
}
?>