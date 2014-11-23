<?php
	$arrMessage;
	$dbConnected = FALSE; //bepaalt of inhoud op de pag mag worden weergegeven of niet

	try 
	{
		$db = new PDO('mysql:host=localhost;dbname=bieren', 'root', 'admin', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		$dbConnected = TRUE;

		if (isset($_GET['delete'])) 
		{
			$deleteValue = $_GET['delete'];

			$queryDelete = '	DELETE 
								FROM brouwers
								WHERE brouwernr = :delete
								LIMIT 1';

			$statementDelete = $db->prepare($queryDelete);
			$statementDelete->bindValue(':delete', $deleteValue);

			if ($statementDelete->execute()) 
			{
				$arrMessage['message'] = 'De datarij werd goed verwijderd.';
				$arrMessage['type'] = 'success';
			}
			else
			{
				$arrMessage['message'] = 'De datarij kon niet verwijderd worden. Probeer opnieuw.';
				$arrMessage['type'] = 'error';
			}
		}

		$query = '	SELECT *
					FROM brouwers';

		$statementSelect = $db->prepare($query);
		$statementSelect->execute();

		$fetchAssoc = array();
		while($row = $statementSelect->fetch(PDO::FETCH_ASSOC))
		{
			$fetchAssoc[] = $row;
		}
	} 
	catch (PDOException $e) 
	{
		$dbConnected = FALSE;
		$arrMessage['message'] = 'Connectie met database is mislukt: '.$e->getMessage(); //Exception van het connecteren met db toevoegen aan de array met messages 
		$arrMessage['type'] = 'error';
	}

	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing opdracht-CRUD-delete-Deel1</title>
	<link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
	<?php if (isset($arrMessage)): ?>				
			<p class="<?= $arrMessage['type'] ?>"><?= $arrMessage['message'] ?></p>
	<?php endif ?>

	<?php if ($dbConnected): ?>
		<table>
			<thead>
				<tr>
					<th>#</th>
					<th>brouwernr (PK)</th>
					<th>brnaam</th>
					<th>adres</th>
					<th>postcode</th>
					<th>gemeente</th>
					<th>omzet</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php if (isset($fetchAssoc)): ?>
					<?php foreach ($fetchAssoc as $index => $rijInhoud): ?>
						<tr class="<?= ((($index+1)%2!=0))? 'odd' : '' ?>">
							<td><?= $index+1 ?></td>
							<?php foreach ($rijInhoud as $kolomInhoud): ?>
								<td><?= $kolomInhoud ?></td>
							<?php endforeach ?>
							<td>
								<form action="oplossing_opdracht-CRUD-delete.php" method="get">
									<input type="image" src="icon-delete.png" name="delete" id="delete" 
									value="<?= $fetchAssoc[$index]["brouwernr"]?>">
								</form>
							</td>
						</tr>
					<?php endforeach ?>
				<?php endif ?>
			</tbody>
			<tfoot></tfoot>
		</table>
	<?php endif ?>
</body>
</html>