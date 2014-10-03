<?php
	$arrEten = array('Spaghetti', 'Frieten', 'Lasagne', 'Pizza');
	$arrResult = array();

	function drukArrayAf($array)
	{
		$length = count($array);

		for ($i=0; $i < $length ; $i++) 
		{ 
			$arrResult[$i] = $arrNaam.'['.$i.'] '.'heeft waarde: '."'". $array[$i]."'";
		}
	}

	drukArrayAf($arrEten);


	function validateHtmlTag($html)
	{

	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing opdracht-functies-Deel2</title>
</head>
<body>
	<p> 
		<?php drukArrayAf($arrEten); ?>
	</p>
</body>
</html>