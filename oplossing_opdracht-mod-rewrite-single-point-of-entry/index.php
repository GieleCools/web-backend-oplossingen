<?php
	
	function autoloader($className)
	{
		include_once 'classes/'.$className.'-class.php';
	}
	spl_autoload_register('autoloader');

	//Klasse aanmaken op basis van de naam van de get-variabele 'controller'
	$str = $_GET['controller'];
	$class = ucfirst($str);
	$controller = new $class();

	//Opvragen welke methode er uitgevoerd moet worden
	$method = $_GET['method'] ;

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing opdracht-mod-rewrite-single-point-of-entry</title>
</head>
<body>
	<h1><?= basename(__FILE__) ?></h1> <!--basisnaam van deze pagina weergeven-->
	<pre>
		<?= var_dump($_GET) ?>
	</pre>
	<h1><?php $controller->$method() ?></h1> <!-- Methode die met de get meegegeven is uitvoeren op de bierenklasse -->
</body>
</html>