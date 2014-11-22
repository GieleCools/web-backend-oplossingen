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
	<link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
	<p class="<?= ($dbConnectMessage)? 'error' : '' ?>">
		<?= $dbConnectMessage ?>
	</p>

	<?php if (!$dbConnectMessage): ?> <!-- Als het errorbericht leeg is, is het connecteren met db gelukt, en mag alles id tabel gezet worden -->
		<table>
			<thead>
				<tr>
					<th>#</th>
					<?php foreach ($fetchRow[0] as $kolomnaam => $value): ?> <!--de eerste rij nemen id array fetchRow, en daarvan de $keys(=kolomnamen) weergeven-->
							<th><?= $kolomnaam ?></th>
					<?php endforeach ?>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($fetchRow as $nummer => $rijInhoud): ?>
					<!--<tr class="<?= (($nummer%2)==0)? 'even' : '' ?>">--> <!-- styling class aan de even rijen geven-->
						<td><?= $nummer ?></td>
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