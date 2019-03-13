<!DOCTYPE HTML>
<html>
<head>
	<link rel="stylesheet" href="../css/style.css" type="text/css" />
	<script src="../js/logic.js" type="text/javascript"></script>
	<title>Campdaten zum Argumente gegen das Zeitgeschehen</title>
	<meta name="Description" content="Intern: Anmeldungen zum AgZ 2017">
	<meta name="viewport" content="width=device-width,initial-scale=1">
</head>
<body>
	<main>
		<article class="anmeldungen">
			<a href="../datenbank/index.php" style="font-size: 0.8em"><- Zurück zur Übersichtsseite</a>
			<h1>Campdaten</h1>
			<p>Allgemeine Campdaten - Zeiten, Kosten etc.</p>
    <form action="./schreibe_campdaten.php" method="post">
			<?php
				include("../mysql/connect.php");

        function print_datepicker($titel, $name, $vorwert) {
          echo "<label>" . $titel . "</label><input type='date' name='" . $name . "' value='" . date("Y-m-d", strtotime($vorwert)) . "' required /> <br />";
        }

        function print_datetimepicker($titel, $name, $vorwert) {
          echo "<label>" . $titel . "</label><input type='datetime-local' name='" . $name . "' value='" . date("Y-m-dTH:i", strtotime($vorwert)) . "' required /> <br />";
        }

        function print_integer($titel, $name, $vorwert) {
          echo "<label>" . $titel . "</label><input min='0' type='number' name='" . $name . "' value='" . intval($vorwert) . "' required /> <br />";
        }

        $daten = $conn->query("SELECT * FROM allgemein")->fetch_assoc();
        print_datepicker("Camp Anfangsdatum", "anfangsdatum", $daten["anfangsdatum"]);
        print_datepicker("Camp Enddatum", "enddatum", $daten["enddatum"]);
        print_datetimepicker("Haus Öffnungszeit", "haus_oeffnungszeit", $daten["haus_oeffnungszeit"]);
        print_datetimepicker("Haus Schließzeit", "haus_schliesszeit", $daten["haus_schliesszeit"]);
        print_integer("Kosten Untere Schranke", "kosten_untere_schranke", $daten["kosten_untere_schranke"]);
        print_integer("Kosen Obere Schranke", "kosten_obere_schranke", $daten["kosten_obere_schranke"]);
			?>
      <input type="submit" value="Schreibe neue Campdaten" target="target">
    </form>
		</article>
	</main>
</body>
</html>
