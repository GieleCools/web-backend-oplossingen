<?php

	session_start();

	$resultaat = "Er werd geen resultaat gevonden.";
	$replacement = '#';

	if (isset($_POST['controleren']) 
		&& !empty($_POST['regularExpression']) 
		&& !empty($_POST['string']))
	{
		$regEx = $_POST['regularExpression'];
		$string = $_POST['string'];
		
		$pattern = '/'.$regEx.'/';
		$replacement = '#';
		$resultaat = preg_replace($pattern, $replacement, $string);
	}

	(isset($_POST['regularExpression']))? $_SESSION['regEx'] = $_POST['regularExpression'] : '';
	(isset($_POST['string']))? $_SESSION['string'] = $_POST['string'] : '';

	//Match alle letters tussen a en d, en u en z (hoofdletters inclusief)
	//Memory can change the shape of a room; it can change the color of a car. 
	//And memories can be distorted. They're just an interpretation, they're not a record, 
	//and they're irrelevant if you have the facts.

	$regEx1 = '/[a-d]|[A-D]|[u-z]|[U-Z]/';
	$string1 = "Memory can change the shape of a room; it can change the color of a car. And memories can be distorted. They're just an interpretation, they're not a record, and they're irrelevant if you have the facts.";
	$resultaat1 = preg_replace($regEx1, $replacement, $string1);

	//Match zowel colour als color
	//Zowel colour als color zijn correct Engels.
	$regEx2 = '/colour|color/';
	$string2 = "Zowel colour als color zijn correct Engels.";
	$resultaat2 = preg_replace($regEx2, $replacement, $string2);

	//Match enkel de getallen die een 1 als duizendtal hebben.
	//1020 1050 9784 1560 0231 1546 8745
	$regEx3 = '/(1+)(\d)(\d)(\d)/';
	$string3 = "1020 1050 9784 1560 0231 1546 8745";
	$resultaat3 = preg_replace($regEx3, $replacement, $string3);

	//Match alle data zodat er enkel een reeks "en" overblijft.
	//24/07/1978 en 24-07-1978 en 24.07.1978
	//$regEx4 = '/([0-3][0-9])[\/-.]([0-1][0-2])[\/-.]([0-9][0-9][0-9][0-9])/';
	// $string4 = "24/07/1978 en 24-07-1978 en 24.07.1978";
	// $resultaat4 = preg_replace($regEx4, $replacement, $string4);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing opdracht-regular-expressions-Deel1</title>
</head>
<body>
<!-- 	<pre>
		Het resultaat:
		<?= var_dump($resultaat) ?>
	</pre>
	<pre>
		De sessie:
		<?= var_dump($_SESSION) ?>
	</pre>
	<pre>
		De post:
		<?= var_dump($_POST)?>
	</pre> -->
	<h1>RegEx tester</h1>
	<form action="index.php" method="post">
		<label for="regularExpression">Regular Expression:</label></br>
		<input type="text" name="regularExpression" id="regularExpression" value="<?= (isset($_SESSION['regEx']))? $_SESSION['regEx'] : ''?>"></br>
		<label for="string">String:</label></br>
		<textarea name="string" id="string" cols="30" rows="10"><?= (isset($_SESSION['string']))? $_SESSION['string'] : ''?></textarea></br>
		<input type="submit" name="controleren" id="controleren" value="Controleren">
	</form>

	<?php if ($resultaat): ?>
		<p>Resultaat: <?= $resultaat ?> </p>
	<?php endif ?>

	<div>
		<p>
			Resultaat 1:</br>
			<?= (!empty($resultaat1))? $resultaat1 : '' ?>
		</p>
		<p>
			Resultaat 2:</br>
			<?= (!empty($resultaat2))? $resultaat2 : '' ?>
		</p>
		<p>
			Resultaat 3:</br>
			<?= (!empty($resultaat3))? $resultaat3 : '' ?>
		</p>
	<!-- 	<p>
			Resultaat 4:</br>
			<?= (!empty($resultaat4))? $resultaat4 : '' ?>
		</p> -->
	</div>
</body>
</html>