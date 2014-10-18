<?php
	session_start();

	var_dump($_SESSION);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing opdracht-session-Deel1-registratie</title>
	<link href="css/style.css" type="text/css" rel="stylesheet">
</head>
<body>
	<h1>Registratiegegevens</h1>
	<form action="oplossing_opdracht-session-adresgegevens.php" method="post">
		<label for="email">e-mail:</label>
		<input type="text" name="email" id="email" class="<?= ($_GET['focus']=='email')? 'focusInput' : '' ?>">
		<br/>
		<label for="nickname">nickname:</label>
		<input type="text" name="nickname" id="nickname" class="<?= ($_GET['focus']==='nickname')? 'focusInput' : '' ?>">
		<input type="submit" value="Volgende" id="submitbutton" name="submitRegistratie">
	</form>
	
</body>
</html>