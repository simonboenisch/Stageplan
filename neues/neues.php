<?php
$text = $_POST["text"];
$func = $_POST["func"];

$db = new SQLite3('neues.db');

if($func == "Senden"){
    $db->exec("INSERT INTO neues (newThing) VALUES ('$text')");
    header("Location: ../navigation.php");
    exit;
}
if($func == "Löschen"){
    $db->exec("DELETE FROM neues");
    header("Location: ../navigation.php");
    exit;
}
