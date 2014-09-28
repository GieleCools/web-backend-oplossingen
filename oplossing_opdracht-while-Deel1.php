<?php
	$i=0;
	$j=0;

	$arrGetallen = array();
	$arrGetallen2= array();
	
	while ( $i< 100) {
		$arrGetallen[$i]=$i;

		if (($i%3)==0 && $i>40 && $i<80) 
		{
			$arrGetallen2[$j]=$i;
			++$j;
		}
		++$i;
	}

	$getallen = implode(', ', $arrGetallen);
	$getallen2 = implode(', ', $arrGetallen2);
	

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<p>
		De getallen van 0 tem 99: <?php echo $getallen?>
	</p>
	<p>
		De getallen tussen 0 en 100 die deelbaar zijn door 3, groter dan 40 en kleiner dan 80: <?php echo $getallen2 ?>
	</p>
</body>
</html>