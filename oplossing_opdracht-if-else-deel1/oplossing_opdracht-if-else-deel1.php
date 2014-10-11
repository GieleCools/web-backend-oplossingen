<?php
	$jaartal = 2012;
	$schrikkeljaarOfNiet = "";

	if (($jaartal%4)==0 || ($jaartal%400)==0 )
	{
		$schrikkeljaarOfNiet = "Ja";
	}
	else
	{
		$schrikkeljaarOfNiet = "Neen";
	}
	if(($jaartal%100)==0)
	{
		$schrikkeljaarOfNiet = "Neen";
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<p> Is het jaartal <?php echo $jaartal ?> een schrikkeljaar? <?php echo $schrikkeljaarOfNiet ?></p>
</body>
</html>