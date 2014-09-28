<?php
	$arrGetallen = array();
	$arrGetallen2 = array();
	$j=0;

	for ($i=0; $i < 100; $i++) 
	{ 
		$arrGetallen[$i]=$i;

		if (($i%3)==0 && $i>40 && $i<80) 
		{
			$arrGetallen2[$j]=$i;
			++$j;
		}
	}

	$getallen = implode($arrGetallen, ', ');
	$getallen2 = implode($arrGetallen2, ', ');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<p>
		<?php echo $getallen ?> 
	</p>
	<p>
		<?php echo $getallen2 ?>
	</p>
</body>
</html>