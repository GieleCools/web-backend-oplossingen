<?php
	$arrDieren = array('schaap', 'olifant', 'paard', 'geit', 'slang');
	$somArrDieren = count($arrDieren);
	$teZoekenDier = 'hond';
	$gevonden = false;
	if (in_array($teZoekenDier, $arrDieren)) 
	{
		$gevonden = true;
	}
	else
	{
		$gevonden = false;
	}

	asort($arrDieren);

	$zoogdieren = array('kat', 'koe', 'hond');
	$dierenLijst = array_merge($arrDieren, $zoogdieren);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<p>
		De array $arrDieren bevat: <?php echo $somArrDieren ?> aantal dieren. <br>
		Zoek <?php echo $teZoekenDier ?> in de array: <?php echo ($gevonden) ? 'gevonden' : 'niet gevonden' ?><br>
		<pre><?php var_dump($arrDieren) ?> </pre><br>
		De samengevoegde array $dierenLijst:
		<pre><?php var_dump($dierenLijst) ?></pre>

	</p>
</body>
</html>