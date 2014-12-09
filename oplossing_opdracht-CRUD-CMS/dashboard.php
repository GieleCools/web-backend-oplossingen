<?php
	
	session_start();

	function autoloader($className)
	{
		include_once 'classes/'.$className.'.php';
	}
	spl_autoload_register('autoloader');

	unset($_SESSION['notification']['activeren']); //anders zal het message terug op de overzichtspagina staan als je er terug naartoe gaat, terwijl je helemaal geen artikel geactiveerd of gedeactiveerd hebt.
	unset($_SESSION['notification']['verwijderen']);

	//unset($_COOKIE['login']); //test voor redirect naar login form indien cookie login niet geset is
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
					// echo "DE HASH van userSaltedEmailHash uit DB IS <br/>"; //de opgebouwde hash en de hash uit de DB weergeven
					// var_dump($userSaltedEmailHash);
					// echo '<br/>';
					// echo "DE HASH van hashedAndSaltedEmailCookie IS <br/>";
					// var_dump($hashedAndSaltedEmailCookie);
					// echo '<br/>';

					//cookie is aangemaakt, persoon is aangemeld, data mag uit de sessie, zodat deze niet terug in het registratieformulier verschijnt
					// unset($_SESSION['data']['email']);
					// unset($_SESSION['data']['randomPassword']);
					// echo "DE LEGE SESSIE VAN HET EMAILADERS: <br/>"; //weergeven of de sessies werkelijk leeg zijn.
					// var_dump($_SESSION['data']['email']);
					// echo "<br/>DE LEGE SESSIE VAN HET RANDOM PASSWORD: <br/>";
					// var_dump($_SESSION['data']['randomPassword']);
				}
				else
				{
					setcookie('login', '', -3600); //cookie verwijderen
					header('Location: login-form.php');
				}
				// echo "DE OPGEVRAAGDE SALT IS <br/>";
				// var_dump($userSalt);
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
	//echo "DE LOGGED IN BOOL IS:";
	//var_dump($loggedIn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Dashboard - Oplossing opdracht CRUD-CMS</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
	<!-- <pre>
		<?= var_dump($_SESSION['data'])?>
	</pre>  -->

	<?php if ($loggedIn): ?>
		<span>Ingelogd als <?= $emailCookie ?> |</span>
		<form action="logout.php" method="post" id="logoutForm">
			<!-- <a href="logout.php">Uitloggen</a>	 -->
			<input type="submit" name="uitlogLink" id="uitlogLink" value="Uitloggen"> <!-- om te kunnen controleren in logout.php of er op deze link gedrukt is, of er gewoon naar de logoutpagina gesurft is -->
		</form>
	<?php endif ?>

	<h1>Dashboard</h1>
	<a href="artikel-overzicht.php">Artikels</a>
</body>
</html>