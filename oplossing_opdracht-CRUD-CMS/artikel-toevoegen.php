<?php

	session_start();

	function autoloader($className)
	{
		include_once 'classes/'.$className.'.php';
	}
	spl_autoload_register('autoloader');

	//unset($_SESSION['notification']); //anders staan er mss nog onnodige messages van andere pagina's 

	$loggedIn = FALSE;
	$emailCookie = FALSE;

	if (isset($_COOKIE['login']))
	{
		try 
		{	
			$cookieData = explode(',', $_COOKIE['login']);
			//var_dump($cookieData);
			$emailCookie = $cookieData[0];							//!!! controleren op email uit cookie, of op email uit sessie???!!!
			//$emailUitSessie = $_SESSION['data']['email'];
			$hashedAndSaltedEmailCookie = $cookieData[1];

			$dbConnection = new PDO('mysql:host=localhost;dbname=opdracht-crud-cms', 'root', 'admin' );
			$db = new Database($dbConnection);

			if (isset($emailCookie)) 
			{
				$querySELECTSalt = "	SELECT salt 					
										FROM users 
										WHERE email = :email "; //salt ophalen uit de users-tabel

				$returnedUser = $db->Query($querySELECTSalt, array('email' => $emailCookie));
				$userSalt = $returnedUser['data'][0]['salt'];
				//$userSalt = 123456; //test of foute salt
				$userSaltedEmailHash = hash('sha512', $userSalt.$emailCookie); //salt uit db gehashed met het door de gebruiker ingegeven emailadres uit sessie
				
				if ($userSaltedEmailHash === $hashedAndSaltedEmailCookie) 
				{
					$loggedIn = TRUE;
				}
				else
				{
					setcookie('login', '', -3600); //cookie verwijderen
					header('Location: login-form.php');
				}
			}
		} 
		catch (Exception $e) 
		{
			$_SESSION['notification']['badConnection'] = array('type' => 'error', 'message' => 'Connectie met database mislukt.');
			header('Location: login-form.php');
		}
	}
	else
	{
		header('Location: login-form.php');
	}

	//invullen van values van het form met waarden uit de sessie
	$titel 			= (!empty($_SESSION['data']['artikel']['titel']))? 	 	 $_SESSION['data']['artikel']['titel'] 		 : '';
	$artikel 		= (!empty($_SESSION['data']['artikel']['artikel']))? 	 $_SESSION['data']['artikel']['artikel'] 	 : '';
	$kernwoorden 	= (!empty($_SESSION['data']['artikel']['kernwoorden']))? $_SESSION['data']['artikel']['kernwoorden'] : '';
	$datum 			= (!empty($_SESSION['data']['artikel']['datum']))? 		 $_SESSION['data']['artikel']['datum'] 		 : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Artikel toevoegen - Oplossing opdracht CRUD-CMS</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
	<?php if ($loggedIn): ?>
		<a href="dashboard.php">Terug naar dashboard</a>
		<span> | Ingelogd als <?= $emailCookie ?> | </span>
		<form action="logout.php" method="post" id="logoutForm">
			<!-- <a href="logout.php">Uitloggen</a>	 -->
			<input type="submit" name="uitlogLink" id="uitlogLink" value="Uitloggen"> <!-- om te kunnen controleren in logout.php of er op deze link gedrukt is, of er gewoon naar de logoutpagina gesurft is -->
		</form>
		<p><a href="artikel-overzicht.php">Terug naar overzicht</a></p>
		
	<?php endif ?>
<!-- <pre>
	<?= var_dump($_SESSION['notification']); ?>
	</pre>  -->
	<h1>Artikel toevoegen</h1>
	
	<?php if (isset($_SESSION['notification'])): ?>
		<?php foreach ($_SESSION['notification'] as $value): ?>
			<p class="<?= $value['type'] ?>"><?= $value['message'] ?></p>
		<?php endforeach ?>
	<?php endif ?>

	<form action="artikels-toevoegen-process.php" method="post">
		<label for="titel">Titel:</label>
		<br/>
		<input type="text" name="titel" id="titel" value="<?= $titel ?>">
		<br/>
		<label for="artikel">Artikel:</label>
		<br/>
		<input type="text" name="artikel" id="artikel" value="<?= $artikel ?>">
		<br/>
		<label for="kernwoorden">Kernwoorden:</label>
		<br/>
		<input type="text" name="kernwoorden" id="kernwoorden" value="<?= $kernwoorden ?>">
		<br/>
		<label for="datum">Datum (dd-mm-jjjj):</label>
		<br/>
		<input type="text" name="datum" id="datum" value="<?= $datum ?>">
		<br/>
		<input type="submit" name="toevoegen" id="toevoegen" value="Artikel toevoegen">
	</form>
</body>
</html>