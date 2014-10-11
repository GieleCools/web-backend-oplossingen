<?php
	$getal = 6;
	$dag = "";

	if ($getal==1)
	{
		$dag = "maandag";
	}

	if ($getal==2)
	{
		$dag = "dinsdag";
	}

	if ($getal==3)
	{
		$dag = "woensdag";
	}

	if($getal==4)
	{
		$dag = "donderdag";
	}

	if($getal==5)
	{
		$dag = "vrijdag";
	}

	if($getal==6)
	{
		$dag = "zaterdag";
	}

	if($getal==7)
	{
		$dag = "zondag";
	}

	$dag =strtoupper($dag);
	$dag2=strtoupper($dag);
	$dag2=str_replace('A', 'a', $dag2);
	$dag3=strtoupper($dag);
	$laatstePosA = strrpos( $dag3, 'A');
	$dag3=substr_replace($dag3, 'a', $laatstePosA, 1);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<p> 
		Het getal is: <?php echo $getal." " ?> en de dag is: <?php echo " ".$dag ?> en : <?php echo $dag3 ?>
	</p>
</body>
</html>