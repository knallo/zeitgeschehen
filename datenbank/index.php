<!DOCTYPE HTML>
<html>
<head>
	<link rel="stylesheet" href="../css/style.css" type="text/css" />
	<script src="../js/logic.js" type="text/javascript"></script>
	<title>Anmeldungen zum Argumente gegen das Zeitgeschehen</title>
	<meta name="Description" content="Intern: Anmeldungen zum AgZ 2017">
	<meta name="viewport" content="width=device-width,initial-scale=1">
</head>
<body>
	<main>
		<article class="anmeldungen">
			<a href="index.php" style="font-size: 0.8em"><- Zurück zur öffentlichen Seite</a>
			<h1>Datenbank</h1>
			<p>Hier können allgemeine Daten zum Camp sowie Daten zum Teilnehmern und Workshops eingesehen und verändert werden.</p>
			<p>Achtung: Die Daten zum Camp sowie den Workshops beeinflussen die öffentlich einsehbare Seite!</p>
			<h2><a href="camp.php">Allgemeine Campdaten</a></h2>
			<h2><a href="teilnehmer.php">Teilnehmerdaten</a></h2>
			<h2><a href="workshopzeiten.php">Workshop Zeitslots</a></h2>
			<h2>Workshops</h2>
			<table>
				<tr>
					<th>Link</th>
				</tr>
				<?php
					include("../mysql/connect.php");

					$resultat = $conn->query("SELECT titel, kuerzel FROM workshops");
					$link_format = "<tr><td><a href='workshop.php?k=%s'>%s</a></td></tr>";

					while ($reihe = $resultat->fetch_assoc()) {
						echo sprintf($link_format, $reihe["kuerzel"], $reihe["titel"]);
					}
				?>
			</table>
			<h2><a href="neuer_workshop.php">Workshop hinzufügen</a><h2>
		</article>
	</main>
</body>
</html>
