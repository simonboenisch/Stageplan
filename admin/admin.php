<?php 
	session_start();
	$pass = $_POST['passwordInput'];
	
	//1845
	if(sha1($pass) == "ce81e9fd4e07b2b70c750eab2c853f56f83d2163"){
		$_SESSION['admin'] = true;
		header("Location: adminpannel.php");
		exit;
	}

?>