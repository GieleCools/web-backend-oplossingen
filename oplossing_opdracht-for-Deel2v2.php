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
	
	<table>
		
		<?php for ($rijen=0; $rijen <=10 ; $rijen++): ?> 
		<tr>
			<?php for ($kolommen=0; $kolommen <=10 ; $kolommen++): ?>
				<td class="<?php echo ((($rijen*$kolommen)%2)==0) ? 'even' : '' ?>">
				<?php echo $rijen*$kolommen ?>
				</td>
			<?php endfor ?>
		<tr>
		<?php endfor ?>

	</table>

</body>
</html>