<?php
	session_start();

	if (isset($_POST['submitAdres']))
	{
		$_SESSION['gegevens']['adres']['straat'] = $_POST['straat'];
		$_SESSION['gegevens']['adres']['nummer'] = $_POST['nummer'];
		$_SESSION['gegevens']['adres']['gemeente'] = $_POST['gemeente'];
		$_SESSION['gegevens']['adres']['postcode'] = $_POST['postcode'];
	}
	$registratie = $_SESSION['gegevens']['registratie'];
	$adres = $_SESSION['gegevens']['adres'];
	var_dump($_SESSION);
	var_dump($_POST);

?>	

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing opdracht-session-overzichtpagina</title>
	<link href="css/style.css" type="text/css" rel="stylesheet">
</head>
<body>
	<ul>	

		<?php foreach ($registratie as $key => $value): ?> <!--sessie in variabele steken zodat deze blok code nog werkt indien men bv niet meer gebruik maakt van een sessie, maar de info op een andere manier opslaat dus een foreach voor $registratie, en niet meer voor $_SESSION['gegevens']['registratie'] -->
			<li>
				<!--<?= $key.': '.$value; ?> Html en php gescheiden houden: eerst key echo'en, dan dubbelpunt in html, daarna value echo'en-->
				<?= $key; ?>: <?= $value; ?>
			
				<a href="oplossing_opdracht-session-registratie.php?focus=<?= $key ?>">| Wijzig</a>
			</li>
			
		<?php endforeach ?>
		<?php foreach ($adres as $key => $value): ?> 
			<li>
				<!-- <?= $key.': '. $value; ?> -->
				<?= $key; ?>: <?= $value; ?>
				<a href="oplossing_opdracht-session-adresgegevens.php?focus=<?= $key ?>">| Wijzig</a>	
			</li>
			
		<?php endforeach ?>
	
	</ul>
	
</body>
</html>