<?php
	session_start();

	$email;
	$nickname;

	if (isset($_SESSION['gegevens']['registratie']['email']))
	{
		$email = $_SESSION['gegevens']['registratie']['email'];
	}
	else
	{ $email = '';}

	if (isset($_SESSION['gegevens']['registratie']['nickname'])) 
	{
		$nickname = $_SESSION['gegevens']['registratie']['nickname'];
	}
	else
	{ $nickname = '';}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing opdracht-session-Deel1-registratie</title>
	<link href="css/style.css" type="text/css" rel="stylesheet">
</head>
<body>
	<pre>
		<?php var_dump($_SESSION); ?>
	</pre>
	<h1>Registratiegegevens</h1>
	<form action="oplossing_opdracht-session-adresgegevens.php" method="post">
		<label for="email">e-mail:</label>
		<input type="text" name="email" value="<?= $email ?>" id="email" <?= (isset($_GET['focus']) && $_GET['focus']=='email')? 'autofocus' : '' ?>>
		<br/>
		<label for="nickname">nickname:</label>
		<input type="text" name="nickname"  value="<?= $nickname ?>" id="nickname" <?= (isset($_GET['focus']) && $_GET['focus']=='nickname')? 'autofocus' : '' ?>>
		<input type="submit" value="Volgende" id="submitbutton" name="submitRegistratie">
	</form>
	
</body>
</html>