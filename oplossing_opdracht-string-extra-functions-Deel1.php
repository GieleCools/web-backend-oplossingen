
<?php
	$fruit = 'kokosnoot';
	$fruitLength = strlen($fruit);
	$letter = 'o';
	$posO = strpos($fruit, $letter);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<p> Hoeveel karakters telt kokosnoot? <?php echo $fruitLength ?> </p>
	<p> Op welke plaats staat de eerste o in $fruit? <?php echo $posO ?> </p>
</body>
</html>