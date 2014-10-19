<?php
	$text = file_get_contents('cookies.txt');
	$arrText = explode(',', $text);
	$warning = '';

	if (isset($_GET['destroy']))
	{
		if ($_GET['destroy']==true) 
		{
			setcookie("correctLogin", 'uitgelogd', time()-3600);
			header('Location: oplossing_opdracht-cookies-Deel1.php');
		}
	}

	if (isset($_POST['submitLogin']))
	{
		if (isset($_POST['username']) && isset($_POST['password'])) 
		{
			if ($_POST['username']===$arrText[0] && $_POST['password']===$arrText[1]) 
			{
				setcookie("correctLogin",'ingelogd', time()+360);
				header('Location: oplossing_opdracht-cookies-Deel1.php');
			}
			else
			{
				$warning = 'Gebruikersnaam en/of paswoord niet correct. Probeer opnieuw.';
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing opdracht-cookies-Deel1</title>
	<link rel="stylesheet" href="style.css" type="text/css">
</head>
	<body>
		<pre>
			<?php var_dump($_COOKIE); ?>
		</pre> 
		<pre>
			<?php var_dump($_POST); ?>
		</pre> 

		<?php if (isset($_COOKIE['correctLogin']) && $_COOKIE['correctLogin']=='ingelogd'): ?>
			<h1>Dashboard</h1>
			<p>U bent ingelogd.</p>
			<a href="oplossing_opdracht-cookies-Deel1.php?destroy=true">Uitloggen</a>
		<?php else: ?>
			<?php if($warning != ''): ?>
				<p class="warning">
					<?= $warning; ?>
				</p>
			<?php endif; ?>
			<form action="oplossing_opdracht-cookies-Deel1.php" method="post">
				<label for="username">Gebruikersnaam:</label><br/>
				<input type="text" name="username" id="username"><br/>
				<label for="password">Paswoord:</label><br/>
				<input type="password" name="password" id="password"><br/>
				<input type="submit" name="submitLogin" value="Aanmelden">
			</form>
		<?php endif; ?>
		<a href="destroyCookie.php" class="destroy">Destroy Cookie</a>
	</body>
</html>