<?php

	function autoloader($className)
	{
		include_once 'classes/'.$className.'.php';
	}
	spl_autoload_register('autoloader');

	if (isset($_COOKIE['login']))
	{
		$dbConnection = new PDO('mysql:host=localhost;dbname=opdracht-security-login', 'root', 'admin' );
		$db = new Database($dbConnection);
	}
	else
	{
		header('Location: login-form.php');
	}

?>