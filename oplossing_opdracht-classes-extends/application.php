<?php
	
	function autoloader($className)
	{
		require_once('classes/'.$className.'.php');
	}

	spl_autoload_register('autoloader');

	$Jos = new Animal('Jos', 'male', 50);
	$Dirk = new Animal('Dirk', 'male', 120);
	$Jan = new Animal('Jan', 'male', 80);

	$arrAnimals = array($Jos, $Dirk, $Jan);

	$JosExtraHealth = 50;
	$DirkExtraHealth = -20;
	$JanExtraHealth = 100;


	if (isset($_POST['changeHealthJos'])) 
	{
		$Jos->changeHealth($JosExtraHealth);
	}
	if (isset($_POST['changeHealthDirk'])) 
	{
		$Dirk->changeHealth($DirkExtraHealth);
	}
	if (isset($_POST['changeHealthJan'])) 
	{
		$Jan->changeHealth($JanExtraHealth);	
	}

	$Simba = new Lion('Simba', 'male', 1200, 'Vlaamse leeuw');
	$Panthera = new Lion('Panthera', 'female', 1000, 'Afrikaanse leeuw');

	$arrLions = array($Simba, $Panthera);

	$Zeppe = new Zebra('Zeke', 'male', 500, 'Zwartwitte zebra');
	$Zikki = new Zebra('Zana', 'female', 400, 'Witzwarte zebra');

	$arrZebras = array($Zeppe, $Zikki);
?>	

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing opdracht classes-extends</title>
</head>
<body>
	<h1>Instanties van de klasse Animal</h1>
	<?php foreach ($arrAnimals as $value): ?>
		<p>
			<?= $value->getName() ?> is van het geslacht <?= $value->getGender() ?> 
			en heeft momenteel <?= $value->getHealth() ?> levenspunten.
		</p>	
		<p>
			De special move van <?= $value->getName()?> : <?= $value->doSpecialMove() ?>.
		</p>
		<form action="application.php" method="post">
			<input type="submit" name="changeHealth<?= $value->getName()?>" id="btnChangeHealth<?=$value->getName()?>" 
			value="Change Health van <?= $value->getName() ?>">
		</form>
	<?php endforeach; ?> 

	<h1>Instanties van de klasse Lion</h1>
	<?php foreach ($arrLions as $value): ?>
		<p>
			De special move van <?= $value->getName() ?> (soort: <?= $value->getSpecies() ?>) is: <?= $value->doSpecialMove() ?>.
		</p>	
	<?php endforeach; ?>

	<h1>Instanties van de klasse Zebra</h1>
	<?php foreach ($arrZebras as $value): ?>
		<p>
			De special move van <?= $value->getName() ?> (soort: <?= $value->getSpecies() ?>) is: <?= $value->doSpecialMove() ?>
		</p>
	<?php endforeach ?>
</body>
</html>