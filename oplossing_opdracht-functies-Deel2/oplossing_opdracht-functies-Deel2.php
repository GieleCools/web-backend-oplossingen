<?php
	$arrEten = array('Spaghetti', 'Frieten', 'Lasagne', 'Pizza');

	$htmlString = '<html><head><title>Dit is html</title></head><body>Inhoud</body></html>';

	function drukArrayAf($array)
	{
		$arrResult = array();
		$length = count($array);

		for ($i=0; $i < $length ; $i++) 
		{ 
			$arrResult[] = '$arrEten'.'['.$i.']'.'heeft waarde: '."'". $array[$i]."'"; //key bij array is niet nodig, want voegt toch bij de array toe
		}
		return $arrResult;
	}

	$arrText = drukArrayAf($arrEten);


	function validateHtmlTag($html)
	{
		$open = '<html>';
		$close = '</html>';
		$isValid = FALSE;

		if (strpos($html, $open)==0)
		{
			if (stripos($html, $close)==(strlen($html)-strlen($close))) 
			{
				$isValid = TRUE;
			}
		}
		return $isValid;
	}

	$htmlValid = validateHtmlTag($htmlString);

	var_dump( $htmlValid );
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing opdracht-functies-Deel2</title>
</head>
<body>
	<p>
		<?php var_dump($arrText); ?>
	<p>
	<p> 
		<ul>
		<?php  foreach ($arrText as $value) : ?>
			<li><?= $value ?></li>
		<?php endforeach ?>
		</ul>
	</p>
	<p> Is de html-tag correct aanwezig? <?= ($htmlValid)?  'Ja' :  'Neen'; ?> </p>
</body>
</html>