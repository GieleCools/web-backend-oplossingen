<?php
	$glas = "leeg";
	

	if ( $glas == "leeg" ) 
	{
		$status = "dorstig";
	}
	
	if ( $glas == "half vol" ) 
	{
		$status = "optimistisch";
	}	

	if ( $glas == "half leeg" ) 
	{
		$status = "pessimistisch";
	}
	
	if ( $glas == "vol" ) 
	{
		$status = "niet dorstig";
	}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Voorbeeld van conditional statements: if & shorthand if</title>
	<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/global.css">
	<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/directory.css">
	<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/facade.css">
</head>
</head>
<body class="web-backend-inleiding">

	<section class="body">
	
		<style>
			.leeg-kleur
			{
				padding:4px;
				color: #b94a48;
				background-color: #f2dede;
				border:1px solid #ebccd1;
				border-radius:2px;
			}
		</style>

		<h1>Voorbeeld van conditional statements: if & shorthand if</h1>

		<p class="<?php echo ( ( $glas == "leeg" ) ? "leeg-kleur" : "" ) ?>">Het glas van Armand is <?php echo $glas ?>, hij is <?php echo $status ?>.</p>

	</section>

</body>
</html>