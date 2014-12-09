<?php
	
	session_start();

	unset($_SESSION['notification']); //alle messages eruit doen, zodat enkel de relevante messages er terug inkomen en weergegeven worden op de doorverwezen pagina

	function autoloader($className)
	{
		include_once 'classes/'.$className.'.php';
	}
	spl_autoload_register('autoloader');

	$_SESSION['data']['artikel']['titel'] 		= FALSE;
	$_SESSION['data']['artikel']['artikel'] 	= FALSE;
	$_SESSION['data']['artikel']['kernwoorden'] = FALSE;
	$_SESSION['data']['artikel']['datum'] 		= FALSE;

	echo "<pre>";
	var_dump($_POST);
	echo "</pre>";

	if (isset($_POST['toevoegen'])
		&& !empty($_POST['titel'])
		&& !empty($_POST['artikel'])
		&& !empty($_POST['kernwoorden'])
		&& !empty($_POST['datum'])
		) 
	{

		$_SESSION['data']['artikel']['titel'] 		= $_POST['titel'];
		$_SESSION['data']['artikel']['artikel'] 	= $_POST['artikel'];
		$_SESSION['data']['artikel']['kernwoorden'] = $_POST['kernwoorden'];
		$_SESSION['data']['artikel']['datum'] 		= $_POST['datum'];

		$datumExploded = explode("-", $_POST['datum']);

		if (   strlen($datumExploded[0]) === 2
			&& strlen($datumExploded[1]) === 2
			&& strlen($datumExploded[2]) === 4
			&& is_numeric($datumExploded[0])
			&& is_numeric($datumExploded[1])
			&& is_numeric($datumExploded[2])
			&& checkdate((int)($datumExploded[1]), (int)($datumExploded[0]), (int)($datumExploded[2]))) 	//Als de datum correct ingegeven is
		{
			$datumFormatted = (int)($datumExploded[2])."-".(int)($datumExploded[1])."-".(int)($datumExploded[0]); //datum op yyyy-mm-dd zetten, zodat de database deze begrijpt
			//echo $datumFormatted;
			try 
			{
				$dbConnection =  new PDO('mysql:host=localhost;dbname=opdracht-crud-cms', 'root', 'admin' );
				$db = new Database($dbConnection);

				$queryINSERT = "	INSERT INTO artikels (titel, artikel, kernwoorden, datum)
									VALUES (:titel, :artikel, :kernwoorden, :datum) ";

				$returnData = $db->Query($queryINSERT, array(	':titel' => $_POST['titel'], 
																':artikel' => $_POST['artikel'],
																':kernwoorden' => $_POST['kernwoorden'],
																':datum' => $datumFormatted));

				//als artikel correct toegevoegd is
				if ($db->uitgevoerd) 
				{
					$_SESSION['notification']['toevoegen'] = array('type' => 'success', 'message' => 'Het artikel werd succesvol toegevoegd.');
					//sessie artikel terug wissen nadat het succesvol toegevoegd is ad db, anders blijven deze waarden ingevuld id values van het formulier om artikels toe te voegen
					unset($_SESSION['data']['artikel']);
					//unset($_SESSION['notification']);
					header('Location: artikel-overzicht.php');	
				}
				else
				{
					$_SESSION['notification']['toevoegen'] = array('type' => 'error', 'message' => 'Het artikel kon niet toegevoegd worden.');
					header('Location: artikel-toevoegen.php');
				}
				//var_dump($db->uitgevoerd);
			} 
			catch (Exception $e) 
			{
				$_SESSION['notification']['badConnection'] = array('type' => 'error', 'message' => 'Connectie met database mislukt.');
				header('Location: artikel-toevoegen.php');
			}
		}
		else //Als de datum foutief ingegeven is
		{
			$_SESSION['notification']['toevoegen'] = array('type' => 'error', 'message' => 'Vul alle velden correct in.');
			header('Location: artikel-toevoegen.php');
		}
	}
	else
	{
		$_SESSION['notification']['toevoegen'] = array('type' => 'error', 'message' => 'Vul alle velden correct in.');
		header('Location: artikel-toevoegen.php');
	}
?>
