<?php
	$password = 'azerty';
	$username = 'Giele';
	$message = '';

	if (isset($_POST['username']) && isset($_POST['password'])) {
		if ($_POST['username']==$username && isset($_POST['password'])==$password) 
		{
			$message = 'Welkom';
		}
		else
		{
			$message = 'Er ging iets mis bij het inloggen, probeer opnieuw.';
		}
	}
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing opdracht-post-Deel1</title>
</head>
<body>
	<form action="oplossing_opdracht-post-Deel1.php" method="post" >
		<label for="username">Username:</label>
		<br />
		<input type="text" name="username" id="username">
		<br/>
		<label for="password">Password:</label>
		<br />
		<input type="password" name="password" id="password">
		<br/>
		<input type="submit" name="submit" value="Submit">

	</form>
	<p>
		<?= $message; ?>
	</p>
	
</body>
</html>