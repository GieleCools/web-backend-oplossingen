<?php
	$aantalSeconden = 221108521;
	$aantalMinuten = 0;
	$aantalUren = 0;
	$aantalDagen = 0;
	$aantalWeken = 0;
	$aantalMaanden = 0;
	$aantalJaren = 0;

	$aantalMinuten = $aantalSeconden/60;
	$aantalUren = $aantalSeconden/3600; 		//60*60=3600
	$aantalDagen = $aantalSeconden/86400;		//24*3600=86400
	$aantalWeken = $aantalSeconden/604800;		//7*86400=604800
	$aantalMaanden = $aantalSeconden/2678400;	//31*86400=2678400
	$aantalJaren = $aantalSeconden/31536000;	//365*86400=31536000

	$aantalMinutenAfgerond = floor($aantalMinuten);
	$aantalUrenAfgerond = floor($aantalUren);
	$aantalDagenAfgerond = floor($aantalDagen);
	$aantalWekenAfgerond = floor($aantalWeken);
	$aantalMaandenAfgerond = floor($aantalMaanden);
	$aantalJarenAfgerond = floor($aantalJaren);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<p>
		In <?php echo $aantalSeconden ?> seconden zitten:
		<ol>
			<li>minuten: <?php echo $aantalMinuten ?></li>
			<li>uren: <?php echo $aantalUren ?></li>
			<li>dagen: <?php echo $aantalDagen ?></li>
			<li>weken: <?php echo $aantalWeken ?></li>
			<li>maanden (31 dagen): <?php echo $aantalMaanden ?></li>
			<li>jaren (365 dagen): <?php echo $aantalJaren ?></li>
		</ol>
	</p>
	<p>
		In <?php echo $aantalSeconden ?> seconden zitten afgerond:
		<ol>
			<li>minuten: <?php echo $aantalMinutenAfgerond ?></li>
			<li>uren: <?php echo $aantalUrenAfgerond ?></li>
			<li>dagen: <?php echo $aantalDagenAfgerond ?></li>
			<li>weken: <?php echo $aantalWekenAfgerond ?></li>
			<li>maanden (31 dagen): <?php echo $aantalMaandenAfgerond ?></li>
			<li>jaren (365 dagen): <?php echo $aantalJarenAfgerond ?></li>
		</ol>
	</p>
</body>
</html>