<?php
	session_start();

	//als de gebruiker ingelogd is, en toch naar deze pagina surft, moet die doorverwezen worden naar het dashboard
	if (isset($_COOKIE['login']))
	{
		header('Location: dashboard.php');
	}

	unset($_SESSION['notification']['logout']); // nu kan je na het uitloggen toch naar registratiepagina gaan, en terug naar het inlogscherm gaan zonder dat het logout bericht er nog staat
	unset($_SESSION['notification']['emailNotFound']);

	$generatedPassword = (isset($_SESSION['data']['randomPassword']))? $_SESSION['data']['randomPassword'] : ''; 
	$email = (isset($_SESSION['data']['email']))? $_SESSION['data']['email'] : '';

	//var_dump($email);

	$nonvalidEmail = (isset($_SESSION['validEmail']) && !$_SESSION['validEmail'])? TRUE : FALSE;

	$arrMessages = (isset($_SESSION['notification']))? $_SESSION['notification'] : FALSE;
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registratie formulier - Oplossing opdracht security-login</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
<!-- 	<pre>
		Valid email?
		<?=  var_dump($_SESSION['validEmail']) ?>
	</pre> 
	<pre>
		arr met messages:
		<?=  var_dump($arrMessages) ?>
	</pre>

	<pre>
		<?php if (isset($_SESSION['passwdTEST'])): ?>
			<?= var_dump($_SESSION['passwdTEST']) ?>
		<?php endif ?>
	</pre> -->

	<h1>Registratie</h1>
	<?php if ($arrMessages): ?>
		<?php foreach ($arrMessages as $category): ?>
				<p class="<?= $category['type'] ?>">
					<?= $category['message']?>
				</p>
		<?php endforeach ?>
	<?php endif ?>
	<form action="registratie-process.php" method="post">
		<label for="email">e-mail:</label>
		<br/>
		<input type="text" name="email" id="email" value="<?= $email ?>" class="<?= ($nonvalidEmail)? 'redfocus' : '' ?>" <?= ($nonvalidEmail)? 'autofocus' : '' ?>>
		<br/>
		<label for="password">Paswoord:</label>
		<br/>
		<input type="text" name="password" id="password" size="30" value="<?= (isset($generatedPassword))? $generatedPassword : '' ?>">
		<input type="submit" name="generatePassword" id="generatePassword" value="Genereer paswoord">
		<br/>
		<input type="submit" name="registreer" id="registreer" value="Registreer">
	</form>
</body>
</html>