<?php
	session_start();

	function autoloader($className)
	{
		include_once 'classes/'.$className.'.php';
	}
	spl_autoload_register('autoloader');
	
	//unset($_SESSION['notification']);

	$loggedIn = FALSE;
	$emailCookie = FALSE;
	$artikelId = FALSE;

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

					if  (isset($_GET['artikel'])) 
					{
						$artikelId = $_GET['artikel'];

						$querySELECT = " 	SELECT * 
											FROM artikels 
											WHERE id = :artikelId 
											LIMIT 1" ; 

						$returnedArtikel = $db->Query($querySELECT, array(':artikelId' => $artikelId));

						if (!empty($returnedArtikel['data'][0]['id'])
							&& !empty($returnedArtikel['data'][0]['titel'])
							&& !empty($returnedArtikel['data'][0]['artikel'])
							&& !empty($returnedArtikel['data'][0]['kernwoorden'])
							&& !empty($returnedArtikel['data'][0]['datum'])) 
						{
							$id 		 = $returnedArtikel['data'][0]['id'];
							$titel 		 = $returnedArtikel['data'][0]['titel'];
							$artikel 	 = $returnedArtikel['data'][0]['artikel'];
							$kernwoorden = $returnedArtikel['data'][0]['kernwoorden'];
							$datumExploded = explode("-", $returnedArtikel['data'][0]['datum']); //exploden en terug omzetten van jjjj-mm-dd naar dd-mm-jjjj

							$datum = $datumExploded[2]."-".$datumExploded[1]."-".$datumExploded[0];
						}
					} 		
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
	<title>Artikel wijzigen - Oplossing opdracht-CRUD-CMS</title>
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

	<h1>Artikel wijzigen</h1>
		<form action="artikels-wijzigen.php" method="post">
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
		<input type="submit" name="toevoegen" id="toevoegen" value="Artikel wijzigen">
		<input type="hidden" name="hiddenID" id="hiddenID" value="<?= $id ?>">
	</form>
</body>
</html>