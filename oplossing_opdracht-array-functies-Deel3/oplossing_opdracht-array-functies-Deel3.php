<?php
	$arrGetallen = array(8, 7, 8, 7, 3, 2, 1, 2, 4);
	$arrGetallen = array_unique($arrGetallen);
	rsort($arrGetallen);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<pre><?php var_dump($arrGetallen) ?> </pre>
</body>
</html>