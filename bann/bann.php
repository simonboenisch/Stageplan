<?php
$bannuser = $_POST['bann'];
$reason = $_POST['reason'];

$file = "banned_users.txt";
$input = $bannuser . "|" . $reason . "\n";

file_put_contents($file, $input, FILE_APPEND);
header('Location: ../admin/adminpannel.php');
?>