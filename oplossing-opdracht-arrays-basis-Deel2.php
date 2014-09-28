<?php
	$arrGetallen = array(1, 2, 3, 4, 5);
	$product = array_product(($arrGetallen));
	$arrGetallen2 = array(5, 4, 3, 2, 1);
	$arrLengte = count($arrGetallen);
	$arrSom;

	for ($i=0; $i <$arrLengte ; $i++) { 
		$arrSom[$i] = $arrGetallen[$i] + $arrGetallen2[$i];
	}

	function odd($var)
{
    // returns whether the input integer is odd
    return($var & 1);
}

print_r(array_filter($arrGetallen, "odd"));


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<p>
		Het product van de array met getallen is: <?php echo $product ?>
	</p>
	<p>
		De twee arrays samengeteld: <br>
		<pre><?php var_dump($arrSom) ?></pre>
	</p>
</body>
</html>