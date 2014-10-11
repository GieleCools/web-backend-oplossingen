<?php
	$text = file_get_contents("text-file-opdracht-foreach.txt");
	$textChars = str_split($text);
	rsort($textChars);						//Sorteer van A naar Z
	$arrReverse = array_reverse($textChars);
	$arrCountChars = array();
	$tellerChars = 0;						//Teller houdt het aantal verschillende karakters bij

	foreach ($arrReverse as $value) 
	{
		if (isset($arrCountChars[$value]))  //checken of er op in de arrCountChars een key is met dezelfde waarde als $value, dus de letter, bv key=a, key=b enz
		{
			++$arrCountChars[$value];		//Als er een key bestaat, met die $value (letter), 
											//dan moet de inhoud van die key met 1 opgeteld worden --> Aantal voorkomens van letters bepalen
		}	
		else
		{
			$arrCountChars[$value]=1;		//key aanmaken en waarde 1 geven
			++$tellerChars;					//Per verschillend karakter de teller optellen
		}
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
		Aantal verschillende karakters: <?= $tellerChars ?>
	</p>
	<pre>
		<?php var_dump($arrCountChars) ?>
	</pre>
</body>
</html>