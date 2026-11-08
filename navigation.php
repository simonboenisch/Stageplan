<?php
session_start();
$sp_user = $_SESSION["user"];

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: loggingIn.html');
    exit;
}
?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation</title>
    <link rel="stylesheet" href="styles/navigation.css">
</head>

<body>
    <header class="header">
        <p class="logo">Stageplan</p>
        <div class="user-section">
            <p class="user-info"><b>Benutzer: </b><?php echo $sp_user; ?></p>
            <a href="logout.php" class="btn-logout">Logout</a>
        </div>
    </header>
    <main>
        <section class="aside">
            <a class="card" href="stageplan.php">
                <p class="card-title">Stageplan</p>
            </a>

            <a class="card" href="umrechner.php">
                <p class="card-title">Rechner</p>
            </a>

            <a class="card" href="termine/termine.php">
                <p class="card-title">Termine</p>
            </a>

            <!--
            <a class="card" href="prompter/prompters.php">
                <p class="card-title">Prompter</p>
            </a>-->

            <a class="card" href="admin/passwordAdmin.php">
                <p class="card-title">Admin</p>
            </a>

        </section>
        <section class="dashbord">
            <div class="main-stuff">
                <h2>Willkommen <?php echo $sp_user; ?>!</h2>
            </div>

            <?php
            // 1. Verbindung zur Datenbank herstellen (Pfad beachten: Ordner "neues" + Dateiname)
            $db = new SQLite3('neues/neues.db');

            // 2. Daten abfragen
            $ergebnis = $db->query("SELECT * FROM neues");
            ?>

            <div id='neues'>
                <h2>Neues: </h2>
                <?php
                // 3. Schleife zum Ausgeben der Einträge
                while ($zeile = $ergebnis->fetchArray(SQLITE3_ASSOC)) {
                    // Hier den korrekten Spaltennamen 'newThing' verwenden!
                    echo $zeile['newThing'] . "<br>";
                }
                ?>
            </div>
        </section>
    </main>


</body>

</html>