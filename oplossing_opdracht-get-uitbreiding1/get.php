<?php
	$artikels = array( 
					array(	'titel'	=>	'HP kiest voor opsplitsing', 
							'datum'	=>	'5/10/2014', 
							'inhoud' => 'De Amerikaanse computergigant HP zou overwegen om zichzelf op te splitsen in twee bedrijven. 
										Dat zou meerwaarde moeten creëren voor de aandeelhouders en het bedrijf meer stroomlijnen.
										Het nieuws is bekendgemaakt door de krant The Wall Street Journal en is nog niet officieel bevestigd. 
										Dat zou volgens de WSJ pas maandag gebeuren tijdens een aankondiging in de hoofdzetel in Palo Alto in Silicon Valley nabij San Francisco.
										HP zou de afdeling die pc\'s en printers maakt, willen loskoppelen en zich voortaan toeleggen op de meer lucratieve toelevering van bedrijven en IT-diensten. 
										Het bedrijf wil echter voorlopig nog niet reageren op de berichten van de WSJ.
										Als het nieuws bevestigd wordt, komt dat hoe dan ook niet als een verrassing. 
										HP is door een aantal overnames uitgegroeid tot een van de grootste bedrijven in de IT-sector en volgens sommige analysten is het te groot en werkt het op te veel vlakken tegelijk.
										Een aantal concurrenten zoals onder meer IBM hebben al eerder hardware zoals pc\'s afgesplitst of verkocht en dat heeft vaak geleid tot een meerwaarde voor de aandeelhouders. 
										De pc-markt is overigens erg concurrentieel en levert vandaag weinig op, al lijkt er de laatste tijd een herstel aan de gang. 
										Net dat kan echter de verkoop van die afdeling aantrekkelijker maken.',
							'afbeelding' => 'HP.jpg',
							'afbeeldingBeschrijving' => 'HP splitst op.'
						),

					array(	'titel' => 'Nummerplaat van oldtimers start voortaan met O',
							'datum' => '6/10/2014',
							'inhoud' => 'Oldtimers maar ook aanhangwagens, motorfietsen, taxi\'s en huurauto\'s met bestuurder krijgen vanaf vandaag bij inschrijving een andere nummerplaat. 
										Tot nu toe kregen deze specifieke voertuigen nog een nummerplaat die begint met 1, zoals de nummerplaten van "gewone" voertuigen. 
										Nu wordt die 1 ingeruild voor een letter. Dat meldt de federale overheidsdienst Mobiliteit. Oldtimers, voertuigen van meer dan 25 jaar oud met een speciaal statuut, 
										krijgen een nummerplaat die begint met O, aanhangwagens met Q, motorfietsen met M en taxi\'s een T. Een oldtimer die voordien 1-OAA-001 had, zal voortaan O-AAA-001 krijgen. 
										Pas bij (her)inschrijving of aanvraag voor een duplicaat zullen de kentekenplaten worden vervangen.
										Net omdat het al om speciale nummerplaten gaat, kunnen eigenaars van oldtimers, motorfietsen, aanhangwagens en taxi\'s geen gepersonaliseerde plaat krijgen.',
							'afbeelding'=> 'oldtimer.jpg',
							'afbeeldingBeschrijving' => 'Zwarte Oldtimer'
						),

					array(	'titel' => 'Mechelen stemt tegen terugplaatsen wijzerplaten aan Sint-Romboutstoren',
							'datum' => '5/10/2014',
							'inhoud' => 'Burgemeester van Mechelen Bart Somers (Open VLD) heeft in de late namiddag de uitslag van de volksraadpleging bekendgemaakt. 
										De wijzerplaten zullen niet teruggehangen worden aan de Sint-Romboutstoren. In totaal stemden er 5974 Mechelaars.
										In totaal kwamen er 5974 Mechelaars opdagen. Daarvan stemden er 2667 voor en 3230 tegen. 77 Mechelaars kwamen wel stemmen, maar onthielden zich.
										Het werd een nipte overwinning, want slechts 54% stemde tegen het terughangen van de wijzerplaten.
										Burgemeester Bart Somers spreekt van een "feest van de democratie."
										De wijzerplaten hingen tot 1963 op de Sint-Romboutstoren, maar waren toen al zwaar beschadigd. 
										Dat gebeurde tijdens een Duits bombardement in de Eerste Wereldoorlog. 
										Vandaag konden de "Maneblussers" kiezen voor of tegen het opnieuw ophangen van het uurwerk op de toren.',
							'afbeelding' => 'Mechelen.jpg',
							'afbeeldingBeschrijving' => 'De Sint-Romboutstouren zonder wijzerplaten.'
						)
				);
	
	$individueelArtikel = false;
	$individueelArtikelID;
	$foutiefArtikel = false;

	if (isset($_GET['id'])) {
		if (array_key_exists($_GET['id'], $artikels)) {
			$individueelArtikel = true;
			$individueelArtikelID = $_GET['id'];
		}
		else //Key bestaat niet
		{
			$individueelArtikel = false;
			$foutiefArtikel = true;
		}
	}

	var_dump($_GET);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Opdracht get</title>
	<link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
	<?php if ($individueelArtikel): ?>
		<div class="individueelArtikel">
			<h1><?= $artikels[$individueelArtikelID]['titel'] ?></h1>
			<p><?=  $artikels[$individueelArtikelID]['datum'] ?></p>
			<img src="img/<?=  $artikels[$individueelArtikelID]['afbeelding'] ?>" alt="<?=  $artikels[$individueelArtikelID]['afbeeldingBeschrijving'] ?>">
			<p><?=  $artikels[$individueelArtikelID]['inhoud'] ?></p>
		</div>

	<?php elseif($foutiefArtikel): ?>
		<h1>Het gezochte artikel bestaat niet.</h1>
	<?php else: ?>

	<?php foreach ($artikels as $key => $value): ?>
		<div class="meerdereArtikels">
			<h1><?= $value['titel'] ?></h1>
			<p><?= $value['datum'] ?></p>
			<img src="img/<?= $value['afbeelding'] ?>" alt="<?= $value['afbeeldingBeschrijving'] ?>">
			<p><?= substr($value['inhoud'], 0, 50).'...' ?></p>
			<a href="get.php?id=<?= $key ?>">Lees meer</a>
		</div>
	<?php endforeach; ?>
	<?php endif ?>
</body>
</html>