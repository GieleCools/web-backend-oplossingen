<?php

	session_start();

	$authentication	= FALSE;
	$userIsValid = FALSE;
	$salt = FALSE;

	function autoloader($className)
	{
		include_once 'classes/'.$className.'.php';
	}
	spl_autoload_register('autoloader');

	unset($_SESSION['notification']); //alle messages wissen.

	if (isset($_POST['inloggen']) 
		&& isset($_POST['email']) 
		&& !empty($_POST['email'])
		&& isset($_POST['password'])
		&& !empty($_POST['password'])) 
	{
		//sessie van notificaties w sowieso bovenaan geleegd
		//unset($_SESSION['notification']['badConnection']); //unset errormessage ivm databaseconnectie, anders blijft deze id sessie staan

		$email = $_POST['email'];
		$password = $_POST['password'];
		$authentication = TRUE;

		try 
		{
			$dbConnection = new PDO('mysql:host=localhost;dbname=opdracht-security-login', 'root', 'admin' );
			$db = new Database($dbConnection);

			//selecteer alle gegevens op basis van emailadres
			$querySELECT = " 	SELECT * 
								FROM users 
								WHERE email = :email ";

			$userData = $db->Query($querySELECT, array(':email' => $email));

			// echo "HET INGEGEVEN EMAILADRES <br/>";
			// echo $_POST['email']."<br/>";
			// echo "DE ONTVANGEN USERDATA: <br/>";
			// var_dump($userData); //test

			if (!isset($userData['data']) || empty($userData['data'])) //email niet in db gevonden
			{
				$_SESSION['notification']['emailNotFound']  = array('type' => 'error', 'message' => 'Het e-mailadres en/of paswoord is ongeldig.');
				header('Location: login-form.php');
			}
			else //email in db gevonden
			{
				if($email && $password)
				{
					foreach($userData['data'] as $user)
					{
						$hashedAndSaltedPassword = hash('sha512', $user['salt'].$password);

						if ($user['email'] == $email && $user['hashed_password'] == $hashedAndSaltedPassword)
						{
							$salt =	$user['salt']; 
							$userIsValid = TRUE;
							break; //eruitgaan als de combinatie van email en passwd gevonden is
						}
						else
						{
							$_SESSION['notification']['emailNotFound']  = array('type' => 'error', 'message' => 'Het e-mailadres en/of paswoord is ongeldig.');
							header('Location: login-form.php');
						}
					}
				}
				if ($authentication && $userIsValid) 
				{
					$hashedAndSaltedEmail = hash('sha512', $salt.$email);
					$cookieValue = $email.','.$hashedAndSaltedEmail;
					setcookie('login', $cookieValue, time()+2592000); //expiration data cookie: 30dagen
					header('Location: dashboard.php');
				}
			}
		} 
		catch (Exception $e) 
		{
			$_SESSION['notification']['badConnectionLogin'] = array('type' => 'error', 'message' => 'Connectie met database mislukt.');
			header('Location: login-form.php');
		}
	}
	else //als men rechtstreeks naar deze pag surft, dus zonder form in te vullen --> redirecten naar login form
	{
		header('Location: login-form.php');
	}
?>