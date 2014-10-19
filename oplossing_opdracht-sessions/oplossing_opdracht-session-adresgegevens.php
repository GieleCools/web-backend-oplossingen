<?php
	session_start();

	if (isset($_POST['submitRegistratie'])) 
	{
		$_SESSION['gegevens']['registratie']['email'] = $_POST['email'];
		$_SESSION['gegevens']['registratie']['nickname'] = $_POST['nickname'];

		if (($_POST['email'] == "") || ($_POST['nickname'] == ""))
		{
			header('Location: oplossing_opdracht-session-registratie.php'); 
			//redirecten naar pag1 als email of nickname leeg was en ingevulde waarde 
			//laten invullen op pag1 met de waarde uit de sessie
		}
	}
	else
	{
		$_SESSION['gegevens']['registratie']['email']="";
		$_SESSION['gegevens']['registratie']['nickname']="";
	}

	$straat = (isset($_SESSION['gegevens']['adres']['straat']))? $_SESSION['gegevens']['adres']['straat'] : '';
	$nummer = (isset($_SESSION['gegevens']['adres']['nummer']))? $_SESSION['gegevens']['adres']['nummer'] : '';
	$gemeente = (isset($_SESSION['gegevens']['adres']['gemeente']))? $_SESSION['gegevens']['adres']['gemeente'] : ''; 
	$postcode = (isset($_SESSION['gegevens']['adres']['postcode']))? $_SESSION['gegevens']['adres']['postcode'] : '';

	var_dump($_SESSION);
	var_dump($_POST);

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing opdracht-session-adresgegevens</title>
	<link href="css/style.css" type="text/css" rel="stylesheet">
</head>
<body>
	<h1>Adresgegevens</h1>
	
	<ul>
		<?php foreach ($_SESSION['gegevens']['registratie'] as $key => $value): ?> 
			<li><?= $key.': '.$value; ?></li>
		<?php endforeach ?>
	</ul>

	<h1>Deel 2: adres</h1>
	<form action="oplossing_opdracht-session-overzichtpagina.php" method="post">
		<label for="straat">Straat:</label>
		<input type="text" name="straat" id="straat" value="<?= $straat ?>" <?= (isset($_GET['focus']) && $_GET['focus']=='straat')? 'autofocus' : '' ?>>
		<br />
		<label for="nummer">Nummer:</label>
		<input type="number" name="nummer" id="nummer" value="<?= $nummer ?>" <?= (isset($_GET['focus']) && $_GET['focus']=='nummer')? 'autofocus' : ''?>>
		<br />
		<label for="gemeente">Gemeente:</label>
		<input type="text" name="gemeente" id="gemeente" value="<?= $gemeente ?>" <?= (isset($_GET['focus']) && $_GET['focus']=='gemeente')? 'autofocus' : ''?>>
		<br />
		<label for="postcode">Postcode:</label>
		<input type="text" name="postcode" id="postcode" value="<?= $postcode ?>" <?= (isset($_GET['focus']) && $_GET['focus']=='postcode')? 'autofocus' : '' ?>>
		<br />
		<input type="submit" name="submitAdres" value="Volgende" id="submitbutton">
	</form>
	<p class="destroy"><a href="destroySession.php">Destroy Session</a></p>

</body>
</html>