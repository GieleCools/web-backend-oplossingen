<?php
	session_start();

	function autoloader($className)
	{
		include_once 'classes/'.$className.'.php';
	}
	spl_autoload_register('autoloader');

	unset($_SESSION['notification']); //alle messages eruit doen, zodat enkel de relevante messages er terug inkomen en weergegeven worden op de doorverwezen pagina

	if (isset($_POST['toevoegen'])
		&& !empty($_POST['hiddenID'])
		&& !empty($_POST['titel'])
		&& !empty($_POST['artikel'])
		&& !empty($_POST['kernwoorden'])
		&& !empty($_POST['datum'])
		) 
	{
		$datumExploded = explode("-", $_POST['datum']);
		var_dump($datumExploded);
	
		if (   strlen($datumExploded[0]) === 2
			&& strlen($datumExploded[1]) === 2
			&& strlen($datumExploded[2]) === 4
			&& is_numeric($datumExploded[1])
			&& is_numeric($datumExploded[0])
			&& is_numeric($datumExploded[2])
			&& checkdate((int)($datumExploded[1]), (int)($datumExploded[0]), (int)($datumExploded[2])))	//checken of het een geldige datum is
		{
			//var_dump($datumExploded);
			//var_dump(checkdate((int)$datumExploded[1], (int)$datumExploded[0], (int)$datumExploded[2]));
			$datumFormatted = (int)($datumExploded[2])."-".(int)($datumExploded[1])."-".(int)($datumExploded[0]); //datum op yyyy-mm-dd zetten, zodat de database deze begrijpt
			echo $datumFormatted;

			try 
			{
				$dbConnection =  new PDO('mysql:host=localhost;dbname=opdracht-crud-cms', 'root', 'admin' );
				$db = new Database($dbConnection);

				$queryUPDATE = "	UPDATE  artikels 
									SET titel = :titel, 
										artikel = :artikel, 
										kernwoorden = :kernwoorden, 
										datum = :datum 
									WHERE id = :hiddenID";

				$returnData = $db->Query($queryUPDATE, array(	':titel' => $_POST['titel'], 
																':artikel' => $_POST['artikel'],
																':kernwoorden' => $_POST['kernwoorden'],
																':datum' => $datumFormatted,
																':hiddenID' => $_POST['hiddenID']));

				//als artikel correct toegevoegd is
				if ($db->uitgevoerd) 
				{
					$_SESSION['notification']['wijzigen'] = array('type' => 'success', 'message' => 'Het artikel werd succesvol gewijzigd.');
					//sessie artikel terug wissen nadat het succesvol toegevoegd is ad db, anders blijven deze waarden ingevuld id values van het formulier om artikels toe te voegen
					header('Location: artikel-overzicht.php');	
				}
				else
				{
					$_SESSION['notification']['wijzigen'] = array('type' => 'error', 'message' => 'Het artikel kon niet gewijzigd worden.');
					header('Location: artikel-wijzigen-form.php');
				}
				//var_dump($db->uitgevoerd);
			} 
			catch (Exception $e) 
			{
				$_SESSION['notification']['badConnection'] = array('type' => 'error', 'message' => 'Connectie met database mislukt.');
				header('Location: artikel-wijzigen-form.php');
			}
		}
		else //Als de datum foutief ingegeven is
		{
			$_SESSION['notification']['wijzigen'] = array('type' => 'error', 'message' => 'Vul alle velden correct in.');
			header('Location: artikel-wijzigen-form.php.php');
		}
	}
	else
	{
		$_SESSION['notification']['wijzigen'] = array('type' => 'error', 'message' => 'Vul alle velden correct in.');
		header('Location: artikel-wijzigen-form.php');
	}
?>