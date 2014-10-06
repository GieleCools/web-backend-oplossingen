<?php
	$rente = (8/100);
	$jaar = 10;
	$geld = 100000;

	$arrResults = array();
	$counter = 0;

	$arrWinst = array();
	$counter2 = 1;

	function berekenGeld($initJaar, $initGeld, $initRente)
	{
		global $arrResults;
		global $counter;
		global $arrWinst;

		if ($initJaar==0) 
		{
			return 1;
		}
		else
		{
			
			--$initJaar;
			$initGeld+=($initRente*$initGeld);
			
			$arrResults[$counter] = floor($initGeld + berekenGeld($initJaar, $initGeld, $initRente));
			$arrWinst[$counter] = floor(($initRente*$initGeld));
			++$counter;
		}
	}

	berekenGeld($jaar, $geld, $rente);
	//$arrResultsReverse = array_reverse($arrResults);
	//$arrWinstReverse = array_reverse($)

	

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing opdracht-recursive</title>
</head>
<body>
	<pre>
		<?php var_dump($arrResults); ?>
		<?php var_dump($arrWinst); ?>
	</pre>

	<?php foreach ($arrResults as $key => $value) 
	{
		echo "Na ".$counter2." jaar, is het bedrag ".$arrResults[($jaar-1)-$key]." en is de winst ".$arrWinst[($jaar-1)-$key]."<br />";
		++$counter2;
	}
	?>
</body>
</html>