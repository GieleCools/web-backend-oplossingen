<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login formulier - Oplossing opdracht security-login</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
	<h1>Inloggen</h1>
	<form action="login-proces.php">
		<label for="email">e-mail:</label><br/>
		<input type="text" name="email" id="email"><br/>
		<label for="email">paswoord:</label><br/>
		<input type="text" name="paswoord" id="paswoord"><br/>
		<input type="submit" name="inloggen" id="inloggen" value="inloggen">
	</form>
	<p>Nog geen account? Maak er dan één aan op de <a href="registratie-form.php">registratiepagina</a>.</p>
</body>
</html>