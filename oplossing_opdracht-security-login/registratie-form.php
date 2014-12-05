<?php
	session_start();

	$generatedPassword = (isset($_SESSION['data']['randomPassword']))? $_SESSION['data']['randomPassword'] : ''; 
	$email = (isset($_SESSION['data']['email']))? $_SESSION['data']['email'] : '';

	var_dump($email);
	// $nonvalidEmail = (	isset($_SESSION['data']['email']) 
	// 					&& isset($_SESSION['validEmail']) 
	// 					&& !$_SESSION['validEmail'] 
	// 					&& isset($_SESSION['notification']))? 
	// 					TRUE : FALSE ; // email geset, en niet valid, en foutmelding -> email is niet valid

	$nonvalidEmail = (isset($_SESSION['validEmail']) && !$_SESSION['validEmail'])? TRUE : FALSE;

	$arrMessages = (isset($_SESSION['notification']))? $_SESSION['notification'] : NULL;
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registratie formulier - Oplossing opdracht security-login</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
	<pre>
		Valid email?
		<?=  var_dump($_SESSION['validEmail']) ?>
	</pre> 
	<pre>
		<?=  var_dump($arrMessages) ?>
	</pre>

	<pre>
		<?php if (isset($_SESSION['passwdTEST'])): ?>
			<?= var_dump($_SESSION['passwdTEST']) ?>
		<?php endif ?>
	</pre>

	<h1>Registratie</h1>
	<?php if (isset($arrMessages)): ?>
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