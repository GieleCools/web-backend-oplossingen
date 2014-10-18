<?php
	session_start();

	if (isset($_POST['submitAdres']))
	{
		$_SESSION['gegevens']['adres']['straat'] = $_POST['straat'];
		$_SESSION['gegevens']['adres']['nummer'] = $_POST['nummer'];
		$_SESSION['gegevens']['adres']['gemeente'] = $_POST['gemeente'];
		$_SESSION['gegevens']['adres']['postcode'] = $_POST['postcode'];
	}
	
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

		<?php foreach ($_SESSION['gegevens']['registratie'] as $key => $value): ?> 
			<li>
				<?= $key.': '.$value; ?>
				<a href="oplossing_opdracht-session-registratie.php?focus=<?= $key ?>">| Wijzig</a>
			</li>
			
		<?php endforeach ?>
		<?php foreach ($_SESSION['gegevens']['adres'] as $key => $value): ?> 
			<li>
				<?= $key.': '. $value; ?>
				<a href="oplossing_opdracht-session-adresgegevens.php?focus=<?= $key ?>">| Wijzig</a>	
			</li>
			
		<?php endforeach ?>
	
	</ul>
	
</body>
</html>