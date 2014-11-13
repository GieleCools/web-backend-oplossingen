<?php
		
	function autoloader($className)
	{
		require_once('classes/'.$className.'.php');
	}

	spl_autoload_register('autoloader');

	$new = 150;
	$unit = 100;
	$percentInstantie = new Percent($new, $unit);
	$absolute = $percentInstantie->absolute;
	$relative = $percentInstantie->relative;
	$hundred = $percentInstantie->hundred;
	$nominal = $percentInstantie->nominal;

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing opdracht-classes-begin</title>
</head>
<body>
	<p>Hoeveel percent is <?= $new ?> van <?= $unit ?>?</p>
	<table>
		<tr>
			<td>Absoluut</td>
			<td><?= $absolute ?></td>
		</tr>
		<tr>
			<td>Relatief</td>
			<td><?= $relative ?></td>
		</tr>
		<tr>
			<td>Geheel getal</td>
			<td><?= $hundred ?></td>
		</tr>
		<tr>
			<td>Nominaal</td>
			<td><?= $nominal ?></td>
		</tr>
	</table>
</body>
</html>