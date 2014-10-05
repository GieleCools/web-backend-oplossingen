<?php
	$rente = (8/100);
	$jaar = 10;
	$geld = 100000;

	$arrResults = array();
	$counter = 0;

	function berekenGeld($initJaar, $initGeld, $initRente)
	{
		global $arrResults;
		global $counter;

		if ($initJaar==0) 
		{
			return 1;
		}
		else
		{
			--$initJaar;
			$initGeld+=($initRente*$initGeld);
			$arrResults[$counter] = $initGeld + berekenGeld($initJaar, $initGeld, $initRente);
			++$counter;
		}
	}

	berekenGeld($jaar, $geld, $rente);
	

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
	</pre>
</body>
</html>