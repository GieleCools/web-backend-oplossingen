<?php
	$artikels = array(
					array(	'titel'	=>	'HP kiest voor opsplitsing', 
							'datum'	=>	'6/10/2014', 
							'inhoud' => 'De huidige bestuursvoorzitter van HP, Meg Whitman, 
										krijgt de leiding over het bedrijf dat zich gaat richten op hardware en ondersteunende diensten. 
										Bestuurder Dion Weisler zal de scepter zwaaien over de tak die pc\'s en printers maakt.',
							'afbeelding' => 'img/HP.jpg',
							'afbeeldingBeschrijving' => 'HP splitst op.'),

					array(	'titel' => 'Nummerplaat van oldtimers start voortaan met O',
							'datum' => '6/10/2014',
							'inhoud' => 'Een oldtimer die voordien 1-OAA-001 had, zal voortaan O-AAA-001 krijgen. 
										Pas bij (her)inschrijving of aanvraag voor een duplicaat zullen de kentekenplaten worden vervangen.',
							'afbeelding'=> 'img/oldtimer.jpg',
							'afbeeldingBeschrijving' => 'Zwarte Oldtimer'),

					array(	'titel' => 'Mechelen stemt tegen terugplaatsen wijzerplaten aan Sint-Romboutstoren',
							'datum' => '5/10/2014',
							'inhoud' => 'In totaal kwamen er 5974 Mechelaars opdagen. Daarvan stemden er 2667 voor en 3230 tegen. 
										77 Mechelaars kwamen wel stemmen, maar onthielden zich.',
							'afbeelding' => 'img/Mechelen.jpg',
							'afbeeldingBeschrijving' => 'De Sint-Romboutstouren zonder wijzerplaten.')
					)



	
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing opdracht-get</title>
	<link href="style.css" type="text/css" rel="stylesheet"></link>
</head>
<body>
	<div>
		<?php foreach ($artikels as $key => $value): ?>
			<div>
				<h2><?= $value['titel']; ?></h2>
				<h5><?= $value['datum']; ?></h5>
				<img src="<?= $value['afbeelding']; ?>" alt = "<?= $value['afbeeldingBeschrijving']; ?>">
				<p>
					<?php 
						if (isset($_GET['id']))
						{
							switch ($_GET['id']) 
							{
								case '0':
								case '1':
								case '2': 
									echo $value['inhoud'];
								break;


								default:
									# code...
									break;
							}
						}
						else
						{
							echo substr($value['inhoud'], 0, 50).'...';
						}
					 ?>
				</p>
				<a href="oplossingen.web-backend.local/oplossing_opdracht-get/oplossing_opdracht-get.php?id=<?= $key ?>">Lees meer></a>
			</div>
		<?php endforeach ?>
	</div>

	
</body>
</html>