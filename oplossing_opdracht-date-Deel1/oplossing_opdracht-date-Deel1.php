<?php

	$timeStamp = mktime(22, 35, 25, 1, 21, 1904);
	$datum = date('d F Y, g:i:s a', $timeStamp);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing opdracht-date-Deel1</title>
</head>
<body>
	<p>De datum is: <?= $datum ?></p>
</body>
</html>