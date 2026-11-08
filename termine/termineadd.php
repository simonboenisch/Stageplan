<?php 
	$title = $_POST['title'];
	$date = $_POST['date'];
	$time = $_POST['time'];
	$teach = $_POST['teacher'];
	
	$db = new SQLite3('termine.db');

	$db->exec("INSERT INTO termine (title, \"date\", \"time\", lehrer) VALUES ('$title', '$date', '$time', '$teach')");

	header('Location: termine.php');
	exit;
?>