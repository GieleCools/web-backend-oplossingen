<?php
	$pigHealth = 5;
	$maximumThrows = 8;
	$arrResultaat = array();

	function calculateHit($initPigHealth)
	{
		$raakkans = rand(0,100);
		$arrStrings = array();

		if ($raakkans<=40) 
		{
			--$initPigHealth;
			$arrStrings['string']='Raak! Er zijn nog maar '.$initPigHealth.' varkens over.';
		}
		else
		{
			$arrStrings['string']='Mis! Nog '.$initPigHealth.' varkens in het team.';
		}

		return $arrStrings;
	}

	function launchAngryBird($initMaximumThrows, $initPigHealth, $initArrResultaat)
	{
		static $aantalKeerAangeroepen;
		
		if($aantalKeerAangeroepen<$initMaximumThrows)
		{
			++$aantalKeerAangeroepen;
			$hitResult = calculateHit($initPigHealth);
			$initArrResultaat[] = $hitResult['string'];
			//echo "<pre>"; var_dump($initArrResultaat); echo  "</pre>";
			launchAngryBird($initMaximumThrows, $initPigHealth, $initArrResultaat);
		}

		if ($aantalKeerAangeroepen==$initMaximumThrows) 
		{
			if ($initPigHealth==0) 
			{
				$initArrResultaat[] = "Je hebt gewonnen!";
			}
			else
			{
				$initArrResultaat[] = "Je hebt verloren!";
			}
		}
	}

	launchAngryBird($maximumThrows, $pigHealth, $arrResultaat);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing opdracht-functies-Deel2</title>
</head>
<body>
	<pre>
		<?php var_dump($arrResultaat) ?>
	</pre>
	<?php foreach ($arrResultaat as  $value): ?> 
	<p>
		<?= $value; ?>
	</p>
	<?php endforeach ?>
</body>
</html>