<?php
	session_start();
	//als de gebruiker ingelogd is, en toch naar deze pagina surft, moet die doorverwezen worden naar het dashboard
	if (isset($_COOKIE['login']))
	{
		header('Location: dashboard.php');
	}

	$arrMessages = (isset($_SESSION['notification']))? $_SESSION['notification'] : FALSE;
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login formulier - Oplossing opdracht security-login</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
	<!-- <pre>
		<?= var_dump($arrMessages) ?>
	</pre> -->
	<h1>Inloggen</h1>
	<?php if ($arrMessages): ?>
		<?php foreach ($arrMessages as $category): ?>
				<p class="<?= $category['type'] ?>">
					<?= $category['message']?>
				</p>
		<?php endforeach ?>
	<?php endif ?>
	<form action="login-process.php" method="post">
		<label for="email">e-mail:</label><br/>
		<input type="text" name="email" id="email"><br/>
		<label for="email">paswoord:</label><br/>
		<input type="password" name="password" id="password"><br/>
		<input type="submit" name="inloggen" id="inloggen" value="inloggen">
	</form>
	<p>Nog geen account? Maak er dan één aan op de <a href="registratie-form.php">registratiepagina</a>.</p>
</body>
</html>