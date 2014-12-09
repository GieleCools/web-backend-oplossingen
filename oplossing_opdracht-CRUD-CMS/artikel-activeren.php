<?php

	session_start();

	function autoloader($className)
	{
		include_once 'classes/'.$className.'.php';
	}
	spl_autoload_register('autoloader');

	unset($_SESSION['notification']);

	$artikelId = FALSE;

	if (isset($_GET['artikel'])) 
	{
		$artikelId = $_GET['artikel'];

		try 
		{
			$dbConnection = new PDO('mysql:host=localhost;dbname=opdracht-crud-cms', 'root', 'admin' );
			$db = new Database($dbConnection);

			//is_active omzetten van 0 naar 1 of 1 naar 0
			$queryUpdate = " 	UPDATE artikels
								SET is_active = 1-is_active
								WHERE id = :artikelId 
								LIMIT 1";

			$db->Query($queryUpdate, array(':artikelId' => $artikelId));
			// $db->uitgevoerd = false; //testen op status wijzigen dat niet uitgevoerd kan worden
			if ($db->uitgevoerd) 
			{
				$querySELECTActive = "	SELECT is_active
										FROM artikels
										WHERE id = :artikelId
										LIMIT 1 ";
									
				$artikelIsActive = $db->Query($querySELECTActive, array(':artikelId' => $artikelId));

				if (isset($artikelIsActive['data'][0]['is_active']) && $artikelIsActive['data'][0]['is_active'])
				{
					$_SESSION['notification']['activeren'] = array('type' => 'success', 'message' => 'Het artikel werd succesvol geactiveerd.');
				}
				else
				{
					$_SESSION['notification']['activeren'] = array('type' => 'success', 'message' => 'Het artikel werd succesvol gedeactiveerd.');
				}
				//var_dump($_SESSION['notification']);
			}
			else
			{
				$_SESSION['notification']['activeren'] = array('type' => 'error', 'message' => 'Status van artikel kon niet aangepast worden.');
			}
		} 
		catch (Exception $e) 
		{
			$_SESSION['notification']['badConnection'] = array('type' => 'error', 'message' => 'Connectie met database mislukt.');
			header('Location: artikel-overzicht.php');
		}
		header('Location: artikel-overzicht.php');
	}
?>