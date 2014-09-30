<?php
	$text = file_get_contents('text-file-opdracht-foreach.txt');
	$arrTextSplit = str_split($text);
	$arrTextSplitLowerCase = array();
	$arrTellerKarakters = array();
	$arrTextSplitLength = count($arrTextSplit);


	for ($i=0; $i <$arrTextSplitLength; $i++) { 
		# code...
	}

	foreach ($arrTextSplit as $value) 
	{
		if (ctype_alpha($value)) 
		{
			if (isset($arrTellerKarakters[$value])) 
			{
				++$arrTellerKarakters[$value];
			}
			else
			{
				$arrTellerKarakters[$value]=1;
			}
		}
	}
	
	/*$arrLettersKlein = array();
	$arrLettersGroot = array();

	$arrLettersKlein = range('a', 'z');
	$arrLettersGroot = range('A', 'Z');
	$arrLetters = array_merge($arrLettersKlein, $arrLettersGroot);
	*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<pre>
		<?php var_dump($arrTextSplitLowerCase) ?>
	</pre>
	
</body>
</html>