<?php
	$rijen=0;
	$kolommen=0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style type="text/css">

			td{border: 1px solid black;}
			.even{background-color: green;}

	</style>
</head>
<body>

	<table>
		<?php while ( $rijen<= 10): ?>
		<tr>
			<?php 
				$kolommen=0;
				while ( $kolommen<= 10): 
			?>
				<td class="<?php echo ((($rijen*$kolommen)%2)==0) ? 'even' : '' ?>">

					<?php 
						echo $rijen*$kolommen;
						++$kolommen;
					?>
				</td>
			<?php endwhile ?>		
		<tr>
			<?php ++$rijen; ?>
	<?php endwhile ?>
			
	</table>
</body>
</html>