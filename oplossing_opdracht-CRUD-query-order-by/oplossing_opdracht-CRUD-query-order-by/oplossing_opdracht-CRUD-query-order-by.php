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

		if (isset($_GET['order_by'])) 
		{
			$arrExplodeGet = explode('-', $_GET['order_by']);

			$query.= "ORDER BY ".$arrExplodeGet[0]." ".strtoupper($arrExplodeGet[1]);		//order by aan de query toevoegen om te kunnen sorteren
		}

		$resultData = $db->Query($query); 										//query sowieso doorgeven aan de instantie van Databaseklasse, alles id functie Query() vd Databaseklasse wordt dan toegepast op deze db instantie, Query() returnt dan een array met de data en kolomnamen	

	} 	
	catch (PDOException $e) 
	{
		new Message("Connecteren met database is mislukt: ".$e->getMessage() , "error");
		$messages = Message::GetMessageOutSession(); //array met messages opvragen uit de Message klasse en in de $message array steken.
	}

	include 'html/head-partial.html';
	include 'html/body-partial.html';
	include 'html/footer-partial.html';

?>