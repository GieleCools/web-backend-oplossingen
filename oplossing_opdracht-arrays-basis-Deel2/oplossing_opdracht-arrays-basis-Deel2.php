<?php
	$arrGetallen = array(1, 2, 3, 4, 5);
	$product = array_product(($arrGetallen));
	$arrGetallen2 = array(5, 4, 3, 2, 1);
	$arrGetallenLengte = count($arrGetallen);
	$arrSom;
	$arrOneven;

	for ($i=0; $i <$arrGetallenLengte ; $i++) 
	{ 
		$arrSom[$i] = $arrGetallen[$i] + $arrGetallen2[$i];
	}

	for ($i=0; $i < $arrGetallenLengte; $i++) 
	{ 
		if (($arrGetallen[$i]%2)!=0) 
		{
			$arrOneven[$i] = $arrGetallen[$i];
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
		Het product van de array met getallen is: <?= $product ?>
	</p>
	<p>
		De twee arrays samengeteld: <br>
		<pre><?php var_dump($arrSom) ?></pre>
	</p>
	<p>
		De oneven getallen: 
			<!--
			<?php for ($i=0; $i < $arrGetallenLengte; $i++): ?>
					<?php if (($arrGetallen[$i]%2)!=0): ?>
						<?= $arrGetallen[$i].', ' ?>
					<?php endif ?>
			<?php endfor ?>
			-->
		<?php var_dump($arrOneven) ?>
	<p>
</body>
</html>