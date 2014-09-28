<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style>
		td{border: 1px solid black;}
		.even{background-color: green;}
	</style>
</head>
<body>
	
	<?php

		echo '<table>';

		for ($i=0; $i <=10; $i++) 
		{ 
			echo '<tr>';
			for ($j=0; $j <=10 ; $j++) 
			{ 
				if((($i*$j)%2)==0)
				{
					echo '<td class="even">';
				}
				else
				{
					echo '<td>';
				}
				echo ($i*$j.'</td>');
			}
			echo '</tr>';
		}

		echo '</table>';
	?>

</body>
</html>