<?php
	$md5HashKey = 'd1fa402db91a7a93c4f414b8278ce073';
	$lengte = strlen($md5HashKey);
	$search = 'a';
	$aantal = 0;

	function teller1($needle, $haystack)
	{
		global $lengte;
		$aantal = substr_count($haystack, $needle);
		$resultaat = ($aantal/$lengte)*100;
		return $resultaat.'%';
	}

	function teller2($needle)
	{
		global $lengte;
		global $md5HashKey;
		$aantal = substr_count($md5HashKey, $needle);
		$resultaat = ($aantal/$lengte)*100;
		return $resultaat.'%';
	}

	function teller3($haystack)
	{
		global $lengte;
		global $search;
		$aantal = substr_count($haystack, $search);
		$resultaat = ($aantal/$lengte)*100;
		return $resultaat.'%';
	}

	$resultaat1 = teller1(2, $md5HashKey);
	$resultaat2 = teller2(8);
	$resultaat3 = teller3($md5HashKey);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<p>
		Functie 1: De needle '2' komt voor <?= $resultaat1 ?> voor in de hash key <?= $md5HashKey ?>
	</p>
		
	<p>
		Functie 2: De needle '8' komt voor <?= $resultaat2 ?> voor in de hash key <?= $md5HashKey ?>
	</p>

	<p>
		Functie 3: De needle 'a' komt voor <?= $resultaat3 ?> voor in de hash key <?= $md5HashKey ?>
	</p>
</body>
</html>