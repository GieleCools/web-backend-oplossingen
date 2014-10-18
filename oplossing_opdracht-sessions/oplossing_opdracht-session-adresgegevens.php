<?php
	session_start();


	if (isset($_POST['submitRegistratie'])) 
	{
		$_SESSION['gegevens']['registratie']['email'] = $_POST['email'];
		$_SESSION['gegevens']['registratie']['nickname'] = $_POST['nickname'];

		if (($_POST['email'] == "") || ($_POST['nickname'] == ""))
		{
			header('Location: oplossing_opdracht-session-registratie.php');
		}
	}
	else
	{
		$_SESSION['gegevens']['registratie']['email']="";
		$_SESSION['gegevens']['registratie']['nickname']="";

	}
	

	
	

	var_dump($_SESSION);
	var_dump($_POST);

	//redirecten naar pag1 als email of nickname leeg was en ingevulde waarde laten invullen op pag1 met de waarde uit de sessie
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
		<input type="text" name="straat" id="straat" class= "<?= ($_GET['focus']=='straat')? 'focusInput' : '' ?>">
		<br />
		<label for="nummer">Nummer:</label>
		<input type="number" name="nummer" id="nummer" class="<?= ($_GET['focus']=='nummer')? 'focusInput' : ''?>">
		<br />
		<label for="gemeente">Gemeente:</label>
		<input type="text" name="gemeente" id="gemeente" class="<?= ($_GET['focus']=='gemeente')? 'focusInput' : ''?>">
		<br />
		<label for="postcode">Postcode:</label>
		<input type="text" name="postcode" id="postcode" class="<?= ($_GET['focus']=='postcode')? 'focusInput' : '' ?>">
		<br />
		<input type="submit" name="submitAdres" value="Volgende" id="submitbutton">
	</form>

</body>
</html>