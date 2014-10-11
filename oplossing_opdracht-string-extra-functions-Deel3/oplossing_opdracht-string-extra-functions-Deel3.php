<?php 
	$lettertje = 'e';
	$cijfertje = '3';
	$langsteWoord = 'zandzeepsodemineralenwatersteenstralen';
	$letterVervanging = str_replace('e', 3, $langsteWoord);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<p>
		Na het vervangen van e door 3: <?php echo $letterVervanging ?>
	</p>

</body>
</html>