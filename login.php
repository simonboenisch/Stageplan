<?php
session_start();


$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

//Useraccounts-Datei-Laden, wenn POST Inhalt hat
if($username == ':)' && $password == 'easteregg') {
    $_SESSION['logged_in_special'] = true;
    header("Location: esteregg.php");
    exit;
}




if ($username != '' && $password != '') {
	$datei = file("stageplan_user_accounts.db");
	$trennzeichen = '|';
	
	for ($i=0; $i<count($datei); $i++) {
		$trennzeichenposition = strrpos($datei[$i], $trennzeichen);
		$userfile = substr($datei[$i], 0, $trennzeichenposition);
		$passwordfile = substr($datei[$i], $trennzeichenposition + 1);
		
		if ($username == trim($userfile) && sha1($password) == trim($passwordfile)) {
			$_SESSION['logged_in'] = true;
			$_SESSION['user'] = $username;
			header("Location: checkban.php");
			exit;
		}
}
		
}

?>



<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Fehler</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <section class="flex flex-col justify-center items-center bg-slate-200 m-20 rounded p-2">
        <h2 class="text-bold text-3xl">Es ist ein Fehler aufgetreten!</h2>
        <p class="text-red-600">Passwort oder Benutzername ist falsch!</p>
        <a href="loggingIn.html" class="bg-slate-300 p-2 rounded m-2">Zurück zum Login</a>
    </section>
</body>
</html>