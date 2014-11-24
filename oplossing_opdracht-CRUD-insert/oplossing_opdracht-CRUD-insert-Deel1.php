<?php

	$errorMessage = false;
	$insertMessage = false;

	if (isset($_GET['submit']))
	{
		try 
		{
			if (!isset($_GET['brnaam']) 		|| $_GET['brnaam'] 	== ''
				|| !isset($_GET['adres']) 		|| $_GET['adres'] 	== ''
				|| !isset($_GET['postcode'])	|| !is_numeric($_GET['postcode'])
				|| !isset($_GET['gemeente'])	|| $_GET['gemeente']== ''
				|| !isset($_GET['omzet']) 		|| !is_numeric($_GET['omzet']))
			{
				throw new Exception('U moet alle invulvelden correct invullen.');
			}
			else
			{
				$brnaam = $_GET['brnaam'];
				$adres = $_GET['adres'];
				$postcode = $_GET['postcode'];
				$gemeente = $_GET['gemeente'];
				$omzet = $_GET['omzet'];

				try 
				{
					$db = new PDO('mysql:host=localhost;dbname=bieren', 'root', 'admin', array (PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
					
					$query = "	INSERT INTO brouwers (brnaam, adres, postcode, gemeente, omzet)
								VALUES (:brnaam, :adres, :postcode, :gemeente, :omzet)";

					$statement = $db->prepare($query);
					$statement->bindValue(':brnaam', $brnaam);
					$statement->bindValue(':adres', $adres);
					$statement->bindValue(':postcode', $postcode);
					$statement->bindValue(':gemeente', $gemeente);
					$statement->bindValue(':omzet', $omzet);

					
					if ($statement->execute())   //statement wordt uitgevoerd, en execute returnt true bij succes, false bij failure
					{
						$insertMessage = 'Brouwerij succesvol toegevoegd. Het unieke nummer van deze brouwerij is '.$db->lastInsertId().'.'; //Returns the ID of the last inserted row or sequence value
					}
					else
					{
						$insertMessage = 'Er ging iets mis met het toevoegen. Probeer opnieuw.';
					}
				} 
				catch (PDOException $e) 
				{
					$errorMessage[] = "Connectie met database is mislukt: ".$e->getMessage(); //Als alle inputvelden gevuld zijn, maar de connectie met db niet lukt, dan komt dit errormessage in de errormessage array.
				}
			}
		} 
		catch (Exception $e) 
		{
			$errorMessage[] = $e->getMessage(); //Als niet alle inputvelden gevuld zijn, wordt er een errormessage in de array gestopt die de gebruiker hiervan op de hoogte stelt.
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing opdracht-CRUD-insert-Deel1</title>
	<link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
	<?php if ($errorMessage): ?>
		<?php foreach ($errorMessage as $value): ?>
			<p class="error"><?= $value ?></p>
		<?php endforeach ?>
	<?php endif ?>
	
	<form action="oplossing_opdracht-CRUD-insert-Deel1.php" method="get">
		<label for="brouwernaam">Brouwernaam</label><br/>
		<input type="text" name="brnaam" id="brnaam"><br/>

		<label for="adres">Adres</label><br/>
		<input type="text" name="adres" id="adres"><br/>

		<label for="postcode">Postcode</label><br/>
		<input type="text" name="postcode" id="postcode"><br/>

		<label for="gemeente">Gemeente</label><br/>
		<input type="text" name="gemeente" id="gemeente"><br/>

		<label for="omzet">Omzet</label><br/>
		<input type="text" name="omzet" id="omzet"><br/>

		<input type="submit" name="submit" id="submit" value="Verzenden">
	</form>
	<?php if ($insertMessage): ?>
		<p class="message">
			<?= $insertMessage ?>
		</p>
	<?php endif ?>
</body>
</html>