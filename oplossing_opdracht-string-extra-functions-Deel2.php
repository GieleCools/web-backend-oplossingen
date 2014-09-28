<?php 
	$fruit = 'ananas';
	$letter = 'a';
	$posA = strrpos($fruit, $letter);
	$fruitHoofdletters=strtoupper($fruit);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<p>
		De laatste a in $fruit is: <?php echo $posA ?>
	</p>
	<p>
		Fruit in hoofdletters: <?php echo $fruitHoofdletters ?>
	</p>

</body>
</html>