<?php

$eingabe = $_POST['test'];

$db = new SQLite3('test.db');
$db->exec("INSERT INTO test (test) VALUES ('$eingabe')");
?>