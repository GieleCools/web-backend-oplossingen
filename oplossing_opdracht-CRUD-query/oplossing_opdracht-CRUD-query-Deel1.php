<?php

	$dbConnectMessage='';

	try 
	{
		$db = new PDO('mysql:host=localhost;dbname=bieren', 'root', 'admin', array (PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

		$query = '	SELECT * 
					FROM bieren 
					INNER JOIN brouwers 
					ON bieren.brouwernr = brouwers.brouwernr 
					WHERE bieren.naam LIKE :bierBegint 
					AND brouwers.brnaam LIKE :brouwernaamBevat';

		$statement = $db->prepare($query);
		$statement->bindValue(':bierBegint', 'du%');
		$statement->bindValue(':brouwernaamBevat', '%a%');
		$statement->execute();

		$fetchRow = array();

		while($row = $statement->fetch(PDO::FETCH_ASSOC))
		{
			$fetchRow[] = $row;
		}
	} 
	catch (PDOException $e) 
	{
		$dbConnectMessage = "Connectie met database is mislukt: ".$e->getMessage();
	}
	

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>oplossing opdracht-CRUD-query-Deel1</title>
	<link rel="stylesheet" href="styleDeel1.css" type="text/css">
</head>
<body>
	<p class="<?= ($dbConnectMessage)? 'error' : '' ?>">
		<?= $dbConnectMessage ?>
	</p>

	<?php if (!$dbConnectMessage): ?> <!-- Als het errorbericht leeg is, is het connecteren met db gelukt, en mag alles id tabel gezet worden -->
		<table>
			<!-- Onderstaande methode lukt alleen als er geen delete wordt uitgevoerd, want er moet hiervoor steeds een rij op index 0 zitten
			<thead>
				<tr>
					<th>#</th>
					<?php foreach ($fetchRow[0] as $kolomnaam => $value): ?> De eerste rij nemen id array fetchRow, en daarvan de $keys(=kolomnamen) weergeven. De kolomnamen moeten hiervoor niet gekend zijn om de inhoud van de kolommen weer te kunnen geven, want het wordt automatisch overlopen.
							<th><?= $kolomnaam ?></th>
					<?php endforeach ?>
				</tr>
			</thead> -->

			<!-- oplossing: hard coded -->
			<thead>
				<tr>
					<th>#</th>
					<th>biernr (PK)</th>
					<th>naam</th>
					<th>brouwernr</th>
					<th>soortnr</th>
					<th>alcohol</th>
					<th>brnaam</th>
					<th>adres</th>
					<th>postcode</th>
					<th>gemeente</th>
					<th>omzet</th>
				</tr>
			</thead>

			<tbody>
				<?php foreach ($fetchRow as $nummer => $rijInhoud): ?> 
					<!--<tr class="<?= ((($nummer+1)%2)==0)? 'even' : '' ?>"> --> <!-- styling class aan de even rijen geven-->
						<td><?= $nummer+1 ?></td>
						<?php foreach ($rijInhoud  as $kolomInhoud): ?>
							<td><?= $kolomInhoud ?></td>
						<?php endforeach ?>
					</tr>
				<?php endforeach ?>
			</tbody>
			<tfoot></tfoot>
		</table>
	<?php endif ?>
</body>
</html>