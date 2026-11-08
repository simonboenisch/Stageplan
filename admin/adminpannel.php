<?php
session_start();

if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: ../loggingIn.html');
    exit;
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Stageplan</title>
    <link rel="stylesheet" href="../styles/admin.css">
    <style>
        
    </style>
</head>
<body>
    <header class="app-header">
        <div>
            <h1 class="header-title">Stageplan</h1>
            <p class="header-subtitle">Admin pannel</p>
        </div>
        <a class="btn-back" href="logoutAdmin.php">Zurück</a>
    </header>

    <main>
        <!-- Passwort zurücksetzen -->
        <form method="POST" action="reset_password.php">
            <section class="admin-section" style="padding-top: 20px;">
                <p class="section-title"><b>Password zurücksetzen</b></p>
                <div class="admin-form">
                    <input type="text" class="form-input form-input-single" placeholder="Benutzername" name="user" required>

                    <div class="form-row">
                        <input type="password" class="form-input" placeholder="Neues Password" name="pass1" required>
                        <input type="password" class="form-input" placeholder="Password bestätigen" name="pass2" required>
                    </div>
                    <input type="submit" class="btn-submit-slate" value="Speichern">
                </div>
            </section>
        </form>
        
        <!-- Neuen Nutzer Anlegen -->
        <section class="admin-section">
            <p class="section-title"><b>Neuen Nutzer Anlegen</b></p>
            <form action="new_user.php" method="post" class="admin-form">
                <input type="text" name="username" class="form-input" placeholder="Benutzername" required>
                <div class="form-row">
                    <input type="password" name="password1" placeholder="Password" class="form-input" required>
                    <input type="password" name="password2" placeholder="Password bestätigen" class="form-input" required>
                </div>
                <input type="submit" value="Registrieren" class="btn-submit-slate">
            </form>
        </section>

        <!-- Nutzer Löschen -->
        <section class="admin-section">
            <p class="section-title"><b>Nutzer Löschen</b></p>
            <form action="delet_user.php" method="post" class="admin-form">
                <input type="text" name="username" class="form-input" placeholder="Benutzername">
                <div class="checkbox-container">
                    <input type="checkbox" name="check" class="form-checkbox">
                    <p>Ich bin mir Sicher</p>
                </div>
                <input type="submit" value="Löschen" class="btn-submit-slate">
            </form>
        </section>
        
        <!-- Nutzer Sperren -->
        <section class="admin-section">
            <p class="section-title"><b>Nutzer Sperren</b></p>
            <form action="../bann/bann.php" method="post" class="admin-form">
                <input type="text" name="bann" class="form-input" placeholder="Benutzername">
                <input type="text" name="reason" class="form-input" placeholder="Grund">
                <input class="btn-submit-blue" type="submit" value="Senden">
            </form>
            
            <div class="nested-section admin-section" style="margin: 20px 0 0 0; padding-left: 0; padding-right: 0; width: 100%;">
                <p class="section-title"><b>Gesperrte Benutzer</b></p>
                <?php
                $eintraege = file("../bann/banned_users.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

                foreach ($eintraege as $index => $eintrag) {
                    if ($index > 0) {
                        echo "<hr class='divider'>";
                    }
                    
                    echo "<div class='display-box'>";
                        echo "<div>" . htmlspecialchars($eintrag) . "</div>";
                        echo "<form action='../bann/endbann.php' method='post' style='margin: 0;'>";
                            echo "<input type='hidden' name='zeilen_index' value='$index'>";
                            echo "<button type='submit' class='btn-unbann'>Entbannen</button>";
                        echo "</form>";
                    echo "</div>";
                }
                ?>
            </div>
        </section>
        




<!--Neues-->

        <section class="admin-section">
            <p class="section-title"><b>Neues Neues:</b></p>
            <form action="../neues/neues.php" method="post" class="admin-form">
                <input type="text" name="text" class="form-input" >
                <input type="submit" name="func" value="Senden" place class="btn-submit-slate">
                <input type="submit" name="func" value="Löschen" place class="btn-submit-slate">
            </form>
        </section>
        




        <!-- Benutzerübersicht -->
        <section class="admin-section">
            <p class="section-title"><b>Benutzer</b></p>
            <?php
            $eintraege = file("../stageplan_user_accounts.db", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        
            foreach ($eintraege as $index => $eintrag) {
                if ($index > 0) {
                    echo "<hr class='divider'>";
                }
                echo "<div class='display-box'>" . htmlspecialchars($eintrag) . "</div>";
            }
            ?>
        </section>
    </main>
</body>
</html>