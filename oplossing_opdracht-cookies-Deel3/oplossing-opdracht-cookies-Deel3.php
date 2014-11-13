<?php
	$login = file_get_contents('login.txt');
	$arrLogin = explode(',', $login);
	$initUsername = $arrLogin[0];
	$initPassword = $arrLogin[1];
	$errormessage = "";

	if (isset($_GET['expired']) && $_GET['expired']) 
	{
		setcookie('login', 'uitgelogd', time()-3600);
		header('Location: oplossing-opdracht-cookies-Deel3.php');	
	}

	if (isset($_POST['submit'])) 
	{
		if (isset($_POST['gebruikersnaam']) && isset($_POST['paswoord'])
			&& $_POST['gebruikersnaam']===$initUsername && $_POST['paswoord']===$initPassword) 
		{
			if ($_POST['onthouden'] === "checked") 
			{
				setcookie('login', 'ingelogd', time()+30*24*60*60); //Cookie met expiration date van 30dagen
			}
			else
			{
				setcookie('login', 'ingelogd', 0); //Cookie die vervalt na het eindigen vd sessie
			}
			header('Location: oplossing-opdracht-cookies-Deel3.php');
		}
		else
		{
			$errormessage = "Je gebruikersnaam of paswoord is foutief.";
		}

	}

	$ingelogdOfNiet = false;
	if (isset($_COOKIE['login']) && $_COOKIE['login']==='ingelogd') 
	{
		$ingelogdOfNiet = true;
	}
	else
	{
		$ingelogdOfNiet = false;
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing opdracht cookies Deel2</title>
	<link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
	<pre>
		<?php var_dump($ingelogdOfNiet) ?>
		<?php var_dump($arrLogin) ?>
	</pre>
	<?php if ($ingelogdOfNiet): ?>
		<h1>Dashboard</h1>
		<p>Hallo <?= ucfirst($initUsername)?>, fijn dat je er weer bij bent!</p> <!--ucfirst: eerste letter van string in hoofdletter zetten -->
		<a href="?expired=true">Uitloggen</a>
	<?php else: ?>
	<h1>Inloggen</h1>
	<p class="errormessage"><?= $errormessage ?></p>
	<form action="oplossing-opdracht-cookies-Deel3.php" method="post">
		<label for="gebruikersnaam">gebruikersnaam</label><br/>
		<input type="text" name="gebruikersnaam" id="gebruikersnaam"><br/>
		<label for="paswoord">paswoord</label><br/>
		<input type="password" name="paswoord" id="paswoord"><br/>
		<input type="checkbox" name="onthouden" id="onthouden" value="checked">
		<label for="onthouden">Onthoud mij</label><br/>
		<input type="submit" name="submit" id="submit" value="Inloggen">
	</form>
	<?php endif ?>
</body>
</html>