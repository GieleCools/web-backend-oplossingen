<?php

	$pigHealth = 5;
	$maximumThrows = 8;

	function calculateHit()
	{
		global $pigHealth;
		static $raakkans = rand(0,100);
		static $geraaktOfNiet = FALSE;

		if ($raakkans<=40) 
		{
			$geraaktOfNiet = TRUE;
		}
		else
		{
			$geraaktOfNiet = FALSE;
		}

		if ($geraaktOfNiet) 
		{
			--$pigHealth;
			return 'Raak! Er zijn nog maar '.$pigHealth.' varkens over.';
		}
		else
		{
			return 'Mis! Nog '.$pigHealth.' varkens in het team.';
		}
	}

	function launchAngryBird()
	{
		global $maximumThrows;
		global $pigHealth;
		static $aantalKeerAangeroepen;

		while ($aantalKeerAangeroepen<$maximumThrows) 
		{
			++$aantalKeerAangeroepen;
			launchAngryBird();
			calculateHit();
		}
		if ($aantalKeerAangeroepen==$maximumThrows) 
		{
			if ($pigHealth==0) 
			{
				return 'Gewonnen!';
			}	
			else 
			{
				return 'Verloren';
			}	
		}
	}

	$resultaat = launchAngryBird();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Opdracht functies-gevorderd-Deel2</title>
</head>
<body>
	<p>
		<?= $resultaat ?>
	</p>
</body>
</html>