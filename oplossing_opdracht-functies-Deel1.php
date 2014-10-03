<?php
	
	$eersteGetal = 2;
	$tweedeGetal = 6;
	$woord = 'Spaghetti';

	function berekenSom($getal1, $getal2)
	{
		return $getal1+$getal2;
	}

	function vermenigvuldig ($getal1, $getal2)
	{
		return $getal1*$getal2;
	}

	function isEven($getal)
	{
		if (($getal%2)==0) 
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function uppercaseAndLength($string)
	{
		$woordUpperCase = strtoupper($string);
		$arrWoord = str_split($woordUpperCase);

		return $arrWoord;
	}

	$arrUpperCase = uppercaseAndLength($woord);
	$woordLength = count($arrUpperCase);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing Opdracht-functies-Deel1</title>
</head>
<body>
	<p>Getal1: <?= $eersteGetal ?></p>
	<p>Getal2: <?= $tweedeGetal ?></p>	
	<p>De som van de getallen is: <?= berekenSom($eersteGetal, $tweedeGetal) ?></p>
	<p>Het product van de getallen is: <?= vermenigvuldig($eersteGetal, $tweedeGetal) ?></p>	
	<p>Is het eerste getal even? <?= isEven($eersteGetal) ?></p>
	<p>Is het tweede getal even? <?= isEven($tweedeGetal) ?></p>
	<p>Het uppercase woord is: 
		<?php for ($i=0; $i <$woordLength ; $i++) 
		{ 
		 echo $arrUpperCase[$i];
		} ?>
	</p>
	<p>De lengte van het woord is: <?= $woordLength ?> </p>
</body>
</html>