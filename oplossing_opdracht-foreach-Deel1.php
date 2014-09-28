<?php
	$text = file_get_contents('text-file-opdracht-foreach.txt');
	$textChars = str_split($text);
	rsort($textChars);
	$textCharsReverse = array_reverse($textChars);
	$arrAantallen = array();
	$aantalVerschillendeKarakters = 0;

	foreach ($textCharsReverse as $value) 
	{
		if (isset($arrAantallen[$value])) 
		{
			$arrAantallen[$value]++;
		}
		else
		{
			$arrAantallen[$value] = 1;
			$aantalVerschillendeKarakters++;
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
		Er zitten zoveel verschillende karakters in de tekst: <?php echo $aantalVerschillendeKarakters; ?>
	</p>
	<p>
		Het voorkomen van de letters: <br>
		
	<pre>
		<?php var_dump($arrAantallen); ?>
	</pre>

</body>
</html>