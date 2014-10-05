<?php
	$arrEten = array('Spaghetti', 'Frieten', 'Lasagne', 'Pizza');
	$arrResult = array();
	$htmlString = '<html><head><title>Dit is html</title></head><body>Inhoud</body></html>';

	function drukArrayAf($array)
	{
		$length = count($array);

		for ($i=0; $i < $length ; $i++) 
		{ 
			$arrResult[$i] = '$arrEten'.'['.$i.'] '.'heeft waarde: '."'". $array[$i]."'";
		}
	}

	drukArrayAf($arrEten);


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
			$isValid = FALSE;
		}
		return $isValid;
	}

	$htmlValid = validateHtmlTag($htmlString);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing opdracht-functies-Deel2</title>
</head>
<body>
	<p> 
		<?php  foreach ($arrResult as $key => $value) 
		{
			echo $value;
		}?>
	</p>
	<p> Is de html-tag correct aanwezig? <?php echo $htmlValid; ?> </p>
</body>
</html>