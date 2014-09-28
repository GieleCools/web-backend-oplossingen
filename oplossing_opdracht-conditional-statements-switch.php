<?php
	$getal = 3;
	$dag;

	switch ($getal) {
		case 1:
			$dag = 'maandag';
			break;
		
		case 2:
			$dag = 'dinsdag';
			break;

		case 3:
			$dag = 'woensdag';
			break;

		case 4:
			$dag = 'donderdag';
			break;

		case 5:
			$dag = 'vrijdag';
			break;

		case 6: 
			$dag = 'zaterdag';
			break;

		case 7: 
			$dag = 'zondag';
			break;

		default:
			$dag= 'Bij dit cijfer hoort geen dag.';
			break;
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
		Bij het getal <?php echo $getal ?> hoort dag: <?php echo $dag ?>
	</p>
</body>
</html>