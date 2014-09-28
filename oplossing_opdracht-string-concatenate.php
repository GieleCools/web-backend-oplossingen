<?php
	$voornaam = 'Giele';
	$achternaam = 'Cools';
	$volledigeNaam = $voornaam.' '.$achternaam;

	$lengte = strlen($volledigeNaam);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
	<p> <?= $volledigeNaam ?> </p>
	<p> <?= $lengte ?> </p>
</body>
</html>