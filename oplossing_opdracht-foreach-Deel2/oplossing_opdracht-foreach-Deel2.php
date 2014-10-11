<?php
	$text = file_get_contents('text-file-opdracht-foreach.txt');
	$arrTextSplit = str_split($text);
	

	foreach ($arrTextSplit as $key => $item) 
	{
		$arrTextSplit[$key] = strtoupper($item);
	}
	
	$arrTellerKarakters = array();


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
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing opdracht-foreach Deel2</title>
</head>
<body>
	<pre>
		<!-- <?php var_dump($arrTellerKarakters) ?> -->
	</pre>
	<p>
		<?php foreach ($arrTellerKarakters as $key => $value): ?>
			<li>
				<?= $key ?> X <?= $value; ?>
			</li>
		<?php endforeach ?>
	</p>
</body>
</html>