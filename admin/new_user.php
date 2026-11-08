<?php
$username = $_POST['username'];
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];

$infile = file_get_contents("../stageplan_user_accounts.db"); #file eintragen
$file = "../stageplan_user_accounts.db"; #file eintragen
if($password1 == $password2){
    $passwordNew = sha1($password1);
    $input = $username . "|" . $passwordNew . "\n";

    file_put_contents($file, $input, FILE_APPEND);
    echo "Nutzer erfolgreich eingetragen!";
    sleep(2);
    header('Location: adminpannel.php');
}else{
    echo "<p>Die passwoerter stimmen nicht ueberein!</p>";
    sleep(2);
    header('Location: adminpannel.php');
}


?>
