<?php
	$rente = (8/100);
	$bedrag = 100000;
	$jaar = 10;
	$arrResult = array();

	function berekenBedrag($initBedrag, $initRente, $initJaar)
	{
		$arrString = array();

		for ($i=1; $i <=$initJaar ; $i++) 
		{ 
			$winst = $initBedrag*$initRente;
			$initBedrag += ($initBedrag*$initRente);
			$arrString[$i] = "Na ".$i." jaar is het bedrag ".floor($initBedrag)." en de winst voor dat jaar is ".floor($winst); 
		}

		return $arrString;
	}

	$arrResult = berekenBedrag($bedrag, $rente, $jaar);


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing opdracht-recursiveV2</title>
</head>
<body>
	<pre>
		<!-- <?php var_dump($arrResult); ?> -->
	</pre>
	<p>
		<?php foreach ($arrResult as $key => $value): ?>
			<li>
				<?php echo $value; ?>
			</li>
		<?php endforeach ?>
	</p>
</body>
</html>