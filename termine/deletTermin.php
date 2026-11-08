<?php 

$name = $_POST['name'];
$db = new SQLite3('termine.db');
$db->exec("DELETE FROM termine WHERE title = '$name'"); 
header('Location: termine.php');
exit;
?>