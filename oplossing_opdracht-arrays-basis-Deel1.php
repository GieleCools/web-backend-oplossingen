<?php
	$arrDieren = array('olifant', 'geit', 'schaap', 'paard', 'walrus', 'vis', 'slang', 'hond', 'kat', 'slak');

	$arrDieren2[0] = 'olifant';
	$arrDieren2[1] = 'geit';
	$arrDieren2[2] = 'schaap';
	$arrDieren2[3] = 'paard';
	$arrDieren2[4] = 'walrus';
	$arrDieren2[5] = 'vis';
	$arrDieren2[6] = 'slang';
	$arrDieren2[7] = 'hond';
	$arrDieren2[8] = 'kat';
	$arrDieren2[9] = 'slak';

	$arrVoertuigen = array('landvoertuigen' => array('auto', 'tractor', 'fiets', 'moto', 'brommer'),
						 'watervoertuigen' => array('boot', 'jetski', 'hovercraft', 'jetpak', 'surfplank'), 
						 'luchtvoertuigen' => array('vliegtuig', 'helikopter', 'parachute', 'F-16', 'luchtballon'))


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing opdracht-arrays-multidimensioneel-Deel1</title>
</head>
<body>
	<p>
		var_dump() van de eerste array:<br>
		<pre><?php var_dump($arrDieren) ?></pre>
	</p>

	<p>
		var_dump() van de tweede array:<br>
		<pre><?php var_dump($arrDieren2) ?></pre>
	</p>

	<p>
		var_dump() van de derde array:<br>
		<pre><?php var_dump($arrVoertuigen) ?></pre>
	</p>
</body>
</html>