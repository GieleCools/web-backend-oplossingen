<?php
	$getal = 2;

	if ($getal==1)
	{
		echo "maandag";
	}

	if ($getal==2)
	{
		echo "dinsdag";
	}

	if ($getal==3)
	{
		echo "woensdag";
	}

	if($getal==4)
	{
		echo "donderdag";
	}

	if($getal==5)
	{
		echo "vrijdag";
	}

	if($getal==6)
	{
		echo "zaterdag";
	}

	if($getal==7)
	{
		echo "zondag";
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<p> 
		Het getal is: <?php echo $getal." " ?> en de dag staat hierboven.
	</p>
</body>
</html>