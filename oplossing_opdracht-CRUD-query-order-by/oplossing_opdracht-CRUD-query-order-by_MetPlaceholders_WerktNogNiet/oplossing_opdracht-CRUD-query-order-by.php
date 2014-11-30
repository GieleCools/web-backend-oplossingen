<?php

	session_start();
	
	$messages = false;
	$resultData = false;

	$arrExplodeGet;

	function autoloader($classname)
	{
		include_once 'classes/'.$classname.'.php';
	}

	spl_autoload_register('autoloader');

	try 
	{
		$dbConnection = new PDO('mysql:host=localhost;dbname=bieren', 'root', 'admin' );
		new Message("Connecteren met database is gelukt", "success");
		$messages = Message::GetMessageOutSession();

		$db = new database($dbConnection); //$database meegeven aan databaseklasse om daarop verdere bewerkingen uit de databaseklasse te kunnen doen

		$query = "	SELECT 	bieren.biernr, 
							bieren.naam, 
					        brouwers.brnaam, 
					        soorten.soort, 
					        bieren.alcohol
				    FROM bieren
				    LEFT JOIN brouwers
				    ON bieren.brouwernr = brouwers.brouwernr
				    LEFT JOIN soorten
				    ON bieren.soortnr = soorten.soortnr ";

		$resultData = $db->Query($query);
		
		if (isset($_GET['order_by'])) 
		{
			$query.="ORDER BY :kolomNaam :sortering"; //order by aan de query toevoegen om te kunnen sorteren
		

			$arrExplodeGet = explode('-', $_GET['order_by']);
			$resultData = $db->Query(	$query, 
										array(':kolomNaam' => $arrExplodeGet[0], 
										':sortering' => strtoupper($arrExplodeGet[1]))); 
			//query en placeholders doorgeven aan de instantie van Databaseklasse, alles id functie Query() vd Databaseklasse wordt dan toegepast op deze db instantie, Query() returnt dan een array met de data en kolomnamen	
		
		}
	} 	
	catch (PDOException $e) 
	{
		new Message("Connecteren met database is mislukt: ".$e->getMessage() , "error");
		$messages = Message::GetMessageOutSession(); //array met messages opvragen uit de Message klasse en in de $message array steken.
	}

	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing opdracht CRUD-query-order-by</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
	<pre>
		<?= var_dump($_SESSION); ?>
	</pre>
	<pre>
		<p>Array met messages:</p>
		<?= var_dump($messages); ?>
	</pre>

	<!-- <pre>
		<p>Opgevraagde data uit DB:</p>
		<?= var_dump($resultData); ?>
	</pre> -->
	
	<pre>
		<p>De GET order_by:</p>
		<?= var_dump($_GET['order_by']); ?>
	</pre>

	<pre>
		<p>De arrExplodeGet</p>
		<?= var_dump($arrExplodeGet); ?>
	</pre>

	<pre>
		<p>DE QUERY SORT</p>
		<?= var_dump($query); ?>
	</pre>

	<?php if (isset($messages)): ?>
		<p class="<?= $messages['type'] ?>">
			<?= $messages['text'] ?>
		</p>
	<?php endif ?>
	
	<table>
		<thead>
			<tr>
				<?php foreach ($resultData['columNames'] as $value): ?>
					<!--<th class="order <?= (isset($arrExplodeGet) && $arrExplodeGet[1]=='desc')? 'descending' : 'ascending' ?>">-->
					<th class="order">
						<a href="oplossing_opdracht-CRUD-query-order-by.php?order_by=<?= $value ?>-<?= (isset($arrExplodeGet) && $arrExplodeGet[1] == 'asc')? 'desc' : 'asc'?>"><?= $value ?> <img src="images/icon-<?= $arrExplodeGet[1] ?>.png"/></a>
					</th>
				<?php endforeach ?>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($resultData['data'] as $arrData): ?>
				<tr>
					<?php foreach ($arrData as $value): ?>
						<td> <?= $value ?> </td>
					<?php endforeach ?>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</body>
</html>