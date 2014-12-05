<?php
	session_start();

	setcookie('login', '', -3600); //cookie verwijderen

	$_SESSION['notification']['logout'] = array('type' => 'text', 'message' => 'U bent uitgelogd, tot de volgende keer.');
	header('Location: login-form.php');
?>