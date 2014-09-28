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
		Zoek <?php echo $teZoekenDier ?> in de array: <?php echo ($gevonden) ? 'gevonden' : 'niet gevonden' ?>
	</p>
</body>
</html>