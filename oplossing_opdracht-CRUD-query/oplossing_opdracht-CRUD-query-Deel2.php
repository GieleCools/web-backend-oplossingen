<?php

	$dbConnectMessage='';
	$submitBierenMessage='';

	try 
	{
		$db = new PDO('mysql:host=localhost;dbname=bieren', 'root', 'admin', array (PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	
		$query = '	SELECT brouwernr, brnaam 
					FROM brouwers';

		$statement = $db->prepare($query);
		$statement->execute();

		$fetchAssoc = array();

		while ($row = $statement->fetch(PDO::FETCH_ASSOC)) 
		{
			$fetchAssoc[] = $row;
		}
	} 
	catch (PDOException $e) 
	{
		$dbConnectMessage =  "Connectie met database is mislukt: ".$e->getMessage();
	}


	$brouwerNrSubmit;

	if (isset($_GET['submit'])) 
	{
		try 
		{
			$brouwerNrSubmit = $_GET['brouwernummer'];	

			$querySubmit = '	SELECT naam 
								FROM bieren
								WHERE bieren.brouwernr = :brouwerNrSubmit';

			$statementSubmit = $db->prepare($querySubmit);
			$statementSubmit->bindValue(':brouwerNrSubmit', $brouwerNrSubmit);
			$statementSubmit->execute();

			$fetchAssocSubmit = array();

			while($row = $statementSubmit->fetch(PDO::FETCH_ASSOC))
			{
				$fetchAssocSubmit[] = $row;
			}	
		} 
		catch (Exception $e) 
		{
			$submitBierenMessage = "U moet een brouwerij kiezen en via de knop bevestigen.";
		}	
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing opdracht-CRUD-query-Deel2</title>
	<link rel="stylesheet" href="styleDeel2.css" type="text/css">
</head>
<body>
	<p class="<?= ($dbConnectMessage)? 'error' : '' ?>">
		<?= $dbConnectMessage ?>
	</p>
	
	<form action="oplossing_opdracht-CRUD-query-Deel2.php" method="get">
		<select name="brouwernummer" id="brouwernummer">
			<?php foreach ($fetchAssoc as $row): ?>
				<option 
					value="<?= $row['brouwernr'] ?>" 
					<?= (isset($brouwerNrSubmit) && ($brouwerNrSubmit==$row['brouwernr']))? 'selected': '' ?>>
						<?= $row['brnaam']?>
				</option>
			<?php endforeach ?>
		</select>
		<input type="submit" name="submit" id="submit" value="Geef mij alle bieren van deze brouwerij">
	</form>

	<?php if (isset($fetchAssocSubmit)): ?>
		<table>
			<thead>
				<tr>
					<th>Aantal</th>
					<th>Naam</th>
				</tr>		
			</thead>
			<tbody>
				<?php foreach ($fetchAssocSubmit as $index => $rijInhoud): ?>					
					<tr class="<?= ((($index%2)==0))? 'odd' : '' ?>">
						<td><?= $index+1 ?></td>
						<?php foreach ($rijInhoud as $kolomInhoud): ?>
							<td><?= $kolomInhoud ?></td>
						<?php endforeach ?>
					</tr>
				<?php endforeach ?>
			</tbody>
			<tfoot></tfoot>
		</table> 
	<?php endif ?>

	<p class="<?= ($submitBierenMessage)? 'error' : '' ?>">
		<?= $submitBierenMessage ?>
	</p>
</body>
</html>