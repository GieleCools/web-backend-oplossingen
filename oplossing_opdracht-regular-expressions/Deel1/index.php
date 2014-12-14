<?php

	session_start();

	$resultaat = "Er werd geen resultaat gevonden.";

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
</body>
</html>