<?php

	session_start();

	function autoloader($className)
	{
		include_once 'classes/'.$className.'.php';
	}
	spl_autoload_register('autoloader');
	
	if (isset($_POST['generatePassword'])) 
	{
		unset($_SESSION['notification']['emptyRandomPassword']);

		//$_SESSION['password'] = generatePassword(true, true, true, true, 14);
		$_SESSION['data']['randomPassword'] = generatePassword(true, true, true, true, 14); //fie geeft paswoordstring terug, en wordt in sessie gestoken
		//echo generatePassword(true, true, true, true, 14); //test

		validateEmail($_POST['email']); 				//foutboodschap ad messages toevoegen indien het emailadres nog niet ingevuld is, of incorrect is terwijl het paswoord gegenereerd moet worden
		header('Location: registratie-form.php');
	}

	if (isset($_POST['registreer'])) 
	{
		//echo "De registratieknop is ingedrukt geweest.";

 		unset($_SESSION['notification']['badConnection']); 		//unset errormessage ivm databaseconnectie, anders blijft deze id sessie staan
 		unset($_SESSION['notification']['emptyRandomPassword']);

		validateEmail($_POST['email']);
		if ($_SESSION['validEmail'] && isset($_SESSION['data']['randomPassword'] )) //email moet geldig zijn, en randomPasswd moet gegenereerd zijn
		{
			checkEmailInDB($_SESSION['data']['email']); 	//email zit in sessie door de validateEmail()-functie	

			if (isset($_SESSION['notification']['badConnection']) 	//als het badConnection message vd database ingesteld is, betekent dat de connectie met db mislukt is, en moet er geredirected w nr registratieform om daar errormessage te kunnen weergeven
			&& !empty($_SESSION['notification']['badConnection'])) 	//badConnection wordt ingesteld in de checkEmailInDB(), daarom eerst email checken, en controleren of de connectie gelukt is of niet
			{
				header('Location: registratie-form.php');
			}	
		}
		else
		{
			//ongeldig e-mailadres -> redirecten naar registratieform, daar wordt de foutboodschap weergegeven
			$_SESSION['notification']['emptyRandomPassword'] = array('type' => 'error', 'message' => 'U moet eerst een paswoord genereren.');//er is nog geen randompassword gegenereerd
			header('Location: registratie-form.php');
		}
	}

	function generatePassword($lowercase, $uppercase, $numeric, $symbols, $length)
	{
		unset($_SESSION['notification']['noRandomPassword']);	//Sessie terug leegmaken, zodat de messages niet in de array blijven staan, en weggaan als het conflict opgelost is.

		$alfabetLower = "abcdefghijklmnopqrstuvwxyz";
		$alfabetUpper = strtoupper($alfabetLower);
		$numericString = "0123456789";
		$symbolString = "/^$*!+-@#";

		$symbolsString = $symbolString;

		$arrBronnen;
		$password = FALSE;

		if ($lowercase) 
		{
			$arrBronnen[] = $alfabetLower;
		}
		if ($uppercase) 
		{
			$arrBronnen[] = $alfabetUpper;
		}
		if ($numeric) 
		{
			$arrBronnen[] = $numericString;
		}
		if ($symbols) 
		{
			$arrBronnen[] = $symbolString;
		}

		if (isset($arrBronnen)) 
		{
			for ($indexPassword = 0; $indexPassword < $length; $indexPassword++) 
			{ 
				$rndBronNr = rand(0,3);
				//$rndBron = FALSE;

				$rndBron = $arrBronnen[$rndBronNr];
				$rndCharacterNr = rand(0, strlen($rndBron)-1); //-1 want random incl maximum, dus anders incl upperbound
				$rndCharacter = $rndBron[$rndCharacterNr]; //randomindex binnen de bron toepassen op de string die op dat moment id bron zit
				$password[$indexPassword] = $rndCharacter;
				//unset($password); //test: mislukken van paswd forceren
			}

			if ($password) 
			{
				$passwordString = implode("", $password); //passwd is array, daarom omzetten naar string en dan returnen
				//$_SESSION['passwdTEST'] = "RANDOM PASWD GELUKT: ".$passwordString; //test
				return $passwordString;
			}
			else
			{
				//$_SESSION['passwdTEST'] = "RANDOM PASWD MISLUKT"; //test
				$_SESSION['notification']['noRandomPassword'] = array('type' => 'error', 'message' => 'Er kon geen paswoord gegenereerd worden.');
			}
		}
		else
		{
			$_SESSION['notification']['noRandomPassword'] = array('type' => 'error', 'message' => 'Er kon geen paswoord gegenereerd worden.');
		}
	}

	function checkEmailInDB($email)
	{
		unset($_SESSION['notification']['emailFound']);			//unset 'emailFound' zodat het niet in de sessie blijft staan als er toch een nieuw e-mailadres ingevoerd wordt

 		try 
		{
			$dbConnection = new PDO('mysql:host=localhost;dbname=opdracht-crud-cms', 'root', 'admin' );
			$db = new Database($dbConnection);

			$querySELECT = "	SELECT email	
								FROM users 
								WHERE email = :email";

			$returnData = $db->Query($querySELECT, array(':email' => $email));
			if (isset($returnData['data']) && !empty($returnData['data'])) 							//e-mailadres komt al voor in db, want returnarray is geset en niet leeg--> heeft dus resultaat uit db
			{
				// echo "<br/> RETURN DATA <br/>";
				// var_dump($returnData['data']);
				//message instellen en redirecten naar registratie-form
				$_SESSION['notification']['emailFound'] = array('type' => 'error', 'message' => 'Het e-mailadres is reeds in gebruik.'); 
				header('Location: registratie-form.php');
			}
			else 												//e-mailadres komt nog niet voor in db
			{
				//gegevens aan db toevoegen
				$salt = uniqid(mt_rand(), true);
				$hashedAndSaltedPassword = hash( 'sha512', $salt.$_SESSION['data']['randomPassword'] );
				//echo "DE HASH IS: ".$hashedAndSaltedPassword; //test

				$queryINSERT = "	INSERT INTO users
  							VALUES ('', :email, :salt, :hashed_password, NOW())";

  				$db->Query($queryINSERT, array(	':email' => $email, 
  												':salt'	 =>	$salt,
  												':hashed_password' => $hashedAndSaltedPassword));

  				//checken of de gebruiker correct toegevoegd is:
  				$queryCheck =  "	SELECT email	
									FROM users 
									WHERE email = :email";

				$returnedUser = $db->Query($queryCheck, array(':email' => $email));
				if (isset($returnedUser) && !empty($returnedUser)) //Controleren of het zonet toegevoegde emailadres effectief in de database zit
				{
					//echo "RETURNDATA VAN DE TWEEDE EMAILCHECK IN DE DATABASE: <br/>"; //test
					//var_dump($returnedUser);												//test
					//cookie aanmaken
					$hashedAndSaltedEmail = hash('sha512', $salt.$email);
					//echo "HASHED en SALTED EMAIL: <br/>"; 		//test
					//var_dump($hashedAndSaltedEmail);			//test
																//test
					$cookieValue = $email.','.$hashedAndSaltedEmail;
					setcookie('login', $cookieValue, time()+2592000); //expiration data cookie: 30dagen
					header('Location: dashboard.php');
				}
			}	
		} 
		catch (Exception $e) 
		{
			$_SESSION['notification']['badConnection'] = array('type' => 'error', 'message' => 'Connectie met database mislukt.');
		}
	}

	function validateEmail($email)
	{
		unset($_SESSION['notification']['invalidEmail']); //Sessie terug leegmaken, zodat de messages niet in de array gestapeld worden, en weggaan als het conflict opgelost is.

		$_SESSION['validEmail'] = FALSE;

		if (isset($email))
		{
			$_SESSION['data']['email'] = $email;
			if (filter_var($email, FILTER_VALIDATE_EMAIL)) 	//filter_var met FILTER_VALIDATE_EMAIL kijkt of e-mail van geldig formaat is of niet.
			{
				//als email geset is, en geldig is --> kijken of het in db voorkomt of niet
				$_SESSION['validEmail'] = TRUE;
				//echo "Email is valid: "; 						//test
				//var_dump($_SESSION['validEmail']); 			//test
			}
			else
			{
				$_SESSION['notification']['invalidEmail'] = array('type' => 'error', 'message' => 'Voer een geldig e-mailadres in.');
			}
		}
		else
		{
			$_SESSION['notification']['invalidEmail'] = array('type' => 'error', 'message' => 'Voer een geldig e-mailadres in.');
		}
	}

	//als men rechtstreeks naar deze pag surft, dus zonder form in te vullen --> redirecten naar login form
	if (!isset($_POST['registreer']) && !isset($_POST['generatePassword'])) 
	{
		header('Location: login-form.php');
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<!--<pre>
		Email:
		<?= var_dump($_SESSION['data']['email']) ?>
	</pre>
	<pre>
		Random password:
		<?= var_dump($_SESSION['data']['randomPassword']) ?>
	</pre>
	<pre>
		<?php if (isset($_SESSION['passwdTEST'])): ?>
			<?= var_dump($_SESSION['passwdTEST']) ?>
		<?php endif ?>
	</pre> -->

</body>
</html>