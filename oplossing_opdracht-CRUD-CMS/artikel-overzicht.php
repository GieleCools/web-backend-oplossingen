<?php

	session_start();

	function autoloader($className)
	{
		include_once 'classes/'.$className.'.php';
	}
	spl_autoload_register('autoloader');

	$loggedIn = FALSE;
	$emailCookie = FALSE;
	$arrArtikels = FALSE;

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
				$userSaltedEmailHash = hash('sha512', $userSalt.$emailCookie); //salt uit db gehashed met het door de gebruiker ingegeven emailadres uit sessie
				
				if ($userSaltedEmailHash === $hashedAndSaltedEmailCookie) 
				{
					$loggedIn = TRUE;

					//als je aangemeld bent, dan ook alle artikels opvragen uit db en ih overzicht weergeven
					$querySELECTActiveArtikels = " 	SELECT *
													FROM artikels
													WHERE is_archived = 0 ";

					$returnedArtikels = $db->Query($querySELECTActiveArtikels);
					$arrArtikels = $returnedArtikels['data'];
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
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Artikel-overzicht - Oplossing opdracht CRUD-CMS</title>
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
	<?php endif ?>

	<h1>Overzicht van de artikels</h1>
<!-- 	 <pre>
		<?= var_dump($_SESSION['notification']) ?>
	</pre>  -->

	<?php if (!empty($_SESSION['notification'])): ?>
		<?php foreach ($_SESSION['notification'] as $value): ?>
			<p class="<?= $value['type'] ?>"><?= $value['message'] ?></p>
		<?php endforeach ?>
	<?php endif ?>
	<a href="artikel-toevoegen.php">Artikel toevoegen</a>
	<?php foreach ($arrArtikels as $artikel): ?>
		<?php if ($artikel['is_archived'] == 0): ?>
			<article class="<?= ($artikel['is_active'])? 'active' : 'inactive' ?>">
				<h1><?= $artikel['titel'] ?></h1>
				<ul>
					<li>Artikel: <?= $artikel['artikel'] ?></li>
					<li>Kernwoorden: <?= $artikel['kernwoorden'] ?></li>
					<li>Datum: <?= date('j-n-Y', strtotime($artikel['datum'])) ?></li> <!-- Datum herschrijven naar dd-mm-jj formaat door de datumstring uit de array om te zetten naar time, en dan te formatteren-->
				</ul>
				<p><a href="artikel-wijzigen-form.php?artikel=<?= $artikel['id'] ?>">artikel wijzigen</a> | <a href="artikel-activeren.php?artikel=<?= $artikel['id'] ?>"><?= ($artikel['is_active']==1)? 'artikel deactiveren' : 'artikel activeren'  ?></a> | <a href="artikel-verwijderen.php?artikel=<?= $artikel['id'] ?>">artikel verwijderen</a></p>
			</article>
		<?php endif ?>
	<?php endforeach ?>
</body>
</html>