<?php
	//Van22u 35m 25sec 21 januari 1904 naar 21 January 1904, 10:35:25 pm
	$timeStamp = mktime(22, 35, 25, 1, 21, 1904);
	$datum = date('d F Y, g:i:s a', $timeStamp);

	setlocale(LC_ALL, 'nl_NL');
	$datumNl = strftime('%e %B %Y, %I:%M:%S %P', $timeStamp);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing opdracht-date-Deel2</title>
</head>
<body>
	<p>De datum is: <?= $datumNl ?></p>
</body>
</html>