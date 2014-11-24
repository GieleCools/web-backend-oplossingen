<?php
	session_start();

	$arrMessage;
	$dbConnected = FALSE; //bepaalt of inhoud op de pag mag worden weergegeven of niet
	$confirmMessage;

	$arrEditBrouwer;
	$editBrouwerError;

	try 
	{
		$db = new PDO('mysql:host=localhost;dbname=bieren', 'root', 'admin', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		$dbConnected = TRUE;

		// if(isset($_POST['edit']))
		// {
		// 	$_SESSION['editValue'] = $_POST['edit'];
		// }

		if (isset($_POST['edit'])) 
		{
			$querySelect = 'SELECT * 
							FROM brouwers
							WHERE brouwernr = :edit';

			$statementSelect = $db->prepare($querySelect);
			$statementSelect->bindValue(':edit', $_POST['edit']);
			
			if ($statementSelect->execute()) 
			{
				while ($row = $statementSelect->fetch(PDO::FETCH_ASSOC)) 
				{
					$arrEditBrouwer = $row;
				}
				
			}
			else
			{
				$editBrouwerError['message'] = "Deze brouwerij werd niet gevonden.";
				$editBrouwerError['type'] = "error";
			}

			//unset($_POST['edit']);
		}

		if (isset($_POST['submit']) 
			&& isset($_POST['brouwernr']) 
			&& isset($_POST['brnaam'])
			&& isset($_POST['adres'])
			&& isset($_POST['postcode'])
			&& isset($_POST['gemeente'])
			&& isset($_POST['omzet'])) 
		{
			$queryUpdate = 'UPDATE brouwers
							SET 	brnaam = :brnaamUpdate, 
									adres = :adresUpdate, 
									postcode = :postcodeUpdate,
									gemeente = :gemeenteUpdate,
									omzet = :omzetUpdate		
							WHERE brouwernr = :brouwernrUpdate';

			$statementUpdate = $db->prepare($queryUpdate);

			$statementUpdate->bindValue(':brouwernrUpdate', $_POST['brouwernr']);
			$statementUpdate->bindValue(':brnaamUpdate', $_POST['brnaam']);
			$statementUpdate->bindValue(':adresUpdate', $_POST['adres']);
			$statementUpdate->bindValue(':postcodeUpdate', $_POST['postcode']);
			$statementUpdate->bindValue(':gemeenteUpdate', $_POST['gemeente']);
			$statementUpdate->bindValue(':omzetUpdate', $_POST['omzet']);
		
			$statementUpdate->execute();
		}

		if (isset($_POST['delete'])) 
		{
			$_SESSION['deleteValue'] = $_POST['delete'];
		}

		if (isset($_SESSION['deleteValue']) 
			&& isset($_POST['deleteConfirm']) 
			&& $_POST['deleteConfirm']=='JA') 
		{	
			$queryDelete = '	DELETE 
								FROM brouwers
								WHERE brouwernr = :delete
								LIMIT 1';

			$statementDelete = $db->prepare($queryDelete);
			$statementDelete->bindValue(':delete', $_SESSION['deleteValue']);

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
			unset($_SESSION['deleteValue']);
		}
		elseif (isset($_POST['deleteConfirm']) && $_POST['deleteConfirm']=='NEE') 
		{
			unset($_SESSION['deleteValue']);
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
	<title>Oplossing opdracht-CRUD-update-Deel1</title>
	<link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
	<?php if (isset($arrMessage)): ?>				
			<p class="<?= $arrMessage['type'] ?>"><?= $arrMessage['message'] ?></p>
	<?php endif ?>

	<?php if (isset($arrEditBrouwer)): ?>
		<h1>Brouwerij <?= $arrEditBrouwer['brnaam']?> (#<?= $arrEditBrouwer['brouwernr']?> ) wijzigen</h1>
		<form action="oplossing_opdracht-CRUD-update-Deel1.php" method="post">
			<label for="brouwernaam">Brouwernaam</label><br/>
			<input type="text" name="brnaam" id="brnaam" value="<?= $arrEditBrouwer['brnaam'] ?>"><br/>

			<label for="adres">Adres</label><br/>
			<input type="text" name="adres" id="adres" value="<?= $arrEditBrouwer['adres'] ?>"><br/>

			<label for="postcode">Postcode</label><br/>
			<input type="text" name="postcode" id="postcode" value="<?= $arrEditBrouwer['postcode'] ?>"><br/>

			<label for="gemeente">Gemeente</label><br/>
			<input type="text" name="gemeente" id="gemeente" value="<?= $arrEditBrouwer['gemeente'] ?>"><br/>

			<label for="omzet">Omzet</label><br/>
			<input type="text" name="omzet" id="omzet" value="<?= $arrEditBrouwer['omzet'] ?>"><br/>

			<input type="submit" name="submit" id="submit" value="Wijzigen">
			<input type="hidden" name="brouwernr" id="brouwernr" value="<?= $arrEditBrouwer['brouwernr'] ?>">
		</form>
	<?php elseif(isset($editBrouwerError)): ?>
		<h1 class="<?= $editBrouwerError['type'] ?>"><?= $editBrouwerError['message'] ?></h1>
	<?php endif ?>

	<?php if (isset($_SESSION['deleteValue'])): ?>
		<form action="oplossing_opdracht-CRUD-update-Deel1.php" method="post" class="confirm">
			<p>Bent u zeker dat u deze datarij wil verwijderen?</p>
			<input type="submit" name="deleteConfirm" id="confirmYes" value="JA">
			<input type="submit" name="deleteConfirm" id="confirmYes" value="NEE">
		</form>
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
					<th colspan="2"></th>
				</tr>
			</thead>
			<tbody>
				<?php if (isset($fetchAssoc)): ?>
					<?php foreach ($fetchAssoc as $index => $rijInhoud): ?>
						<tr class="	<?= ((($index+1)%2!=0))? 'odd ' : '' ?> 
									<?= (isset($_SESSION['deleteValue']) && $_SESSION['deleteValue']==$rijInhoud['brouwernr'])? 'selectedDelete' : '' ?>">
							<td><?= $index+1 ?></td>
							<?php foreach ($rijInhoud as $kolomInhoud): ?>
								<td><?= $kolomInhoud ?></td>
							<?php endforeach ?>
							<td>
								<form action="oplossing_opdracht-CRUD-update-Deel1.php" method="post">
									<input type="image" src="icon-delete.png" name="delete" id="delete" 
									value="<?= $fetchAssoc[$index]["brouwernr"]?>">
								</form>
							</td>
							<td>
								<form action="oplossing_opdracht-CRUD-update-Deel1.php" method="post">
									<input type="image" src="icon-edit.png" name="edit" id="edit" 
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