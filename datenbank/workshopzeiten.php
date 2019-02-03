<!DOCTYPE HTML>
<html>
<head>
	<link rel="stylesheet" href="../css/style.css" type="text/css" />
	<script src="../js/logic.js" type="text/javascript"></script>
	<title>Workshopzeiten des Argumente gegen das Zeitgeschehens</title>
	<meta name="Description" content="Intern: Anmeldungen zum AgZ 2017">
	<meta name="viewport" content="width=device-width,initial-scale=1">
</head>
<body>
	<main>
		<article class="anmeldungen">
			<a href="../datenbank/index.php" style="font-size: 0.8em"><- Zurück zur Übersichtsseite</a>
			<h1>Workshopzeiten</h1>
			<p>Anfangs und Enddaten der Slots</p>
			<iframe style="display:none;" name="target"></iframe>
    <form action="./schreibe_workshopzeiten.php" method="post" target="target">
			<?php
				include("../mysql/connect.php");

				$schluessel = array("erste_schiene_anfang", "erste_schiene_erstes_zwischenende", "erste_schiene_erster_zwischenanfang", "erste_schiene_zweites_zwischenende", "erste_schiene_zweiter_zwischenanfang", "erste_schiene_ende", "zweite_schiene_anfang", "zweite_schiene_erstes_zwischenende", "zweite_schiene_erster_zwischenanfang", "zweite_schiene_zweites_zwischenende", "zweite_schiene_zweiter_zwischenanfang", "zweite_schiene_ende");

        function print_datetimepicker($name, $vorwert) {
					$titel = ucwords(str_replace("_", " ", $name));
          echo "<label>" . $titel . "</label><input type='datetime-local' name='" . $name . "' value='" . date("Y-m-dTH:i", strtotime($vorwert)) . "' required /> <br />";
        }

        $daten = $conn->query("SELECT * FROM workshops_zeit")->fetch_assoc();

				foreach ($schluessel as &$key) {
					print_datetimepicker($key, $daten[$key]);
				}
			?>
      <input type="submit" value="Schreibe neue Workshopzeiten" target="_BLANK">
    </form>
		</article>
	</main>
</body>
</html>
