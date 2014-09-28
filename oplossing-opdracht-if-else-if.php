<?php
	$randomGetal = rand(1, 100);
	$tiental1;
	$tiental2;
	$zin = "";
	$zinReverse;

	if(($randomGetal%10)==0)
	{
		$zin = "Het getal ligt in het tiental ".$randomGetal;
	}
	elseif(($randomGetal%10)!=0)
	{
		$tiental1=floor($randomGetal/10)*10;
		$tiental2=ceil($randomGetal/10)*10;
		$zin = "Het getal ligt tussen de tientallen ".$tiental1." en ".$tiental2;
	}
	
	$zinReverse = strrev($zin);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<p>
		Het getal is: <?php echo $randomGetal ?> <br>
		<?php echo $zin ?> <br>
		<?php echo $zinReverse ?>
	</p>
</body>
</html>