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
			<a href="http://zeitgeschehen.net" style="font-size: 0.8em"><- Zurück zur öffentlichen Seite</a>
			<h1>Anmeldungen</h1>
			<p>Bei den Anwesenheits-Tagen steht ein "x" für "ist da" und ein "0" für "ist nicht da"; die erste Ziffer steht für den ersten Tag, die zweite für den zweiten usw.
			00xxx würde also bspw. heißen: Nur an den letzten drei Tagen da.</p>
			<?php
				include("../mysql/connect.php");

				//creates a html table from mysql data.
				//tabellen_spalten is an associative array where the keys are the database column names, and the values are the table header names.
				//daten is an array of associative arrays with the data
				function erstelle_tabelle($tabellen_spalten, $daten) {
					echo "<table>";
					//headers
					$schluessel = array_keys($tabellen_spalten);
					echo "<tr>";
					foreach ($schluessel as &$key) {
						echo "<th>";
						echo $tabellen_spalten[$key];
						echo "</th>";
					}
					echo "</tr>";

					//rows
					foreach ($daten as &$reihe) {
						echo "<tr>";
						foreach ($schluessel as &$key) {
							echo "<td>";
							echo $reihe[$key];
							echo "</td>";
						}
						echo "</tr>";
					}

					echo "</table>";
				}

				//verwandelt ein mysqli resultat in ein array von assoziativen arrays
				function resultat_zu_array($resultat) {
					$daten = array();
					$reihe = $resultat->fetch_assoc();
					$schluessel = array_keys($reihe);
					do {
						$neuer_eintrag = array();

						foreach ($schluessel as &$key) {
							$neuer_eintrag[$key] = $reihe[$key];
						}

						$daten[] = $neuer_eintrag;
					} while ($reihe = $resultat->fetch_assoc());

					return $daten;
				}

				//reichert ein array von assoziativen arrays um zusätzliche daten an
				//daten ist das array
				//position ist die position im array wo die zusätzlichen daten reinsollen
				//zusatz ist ein array mit den zusätzlichen daten
				//neuer schluessel ist der schluessel unter dem die neuen daten gespeichert werden sollen
				function reichere_daten_an($daten, $position, $zusatz, $neuer_schluessel) {
					$neue_daten = array();
					$schluessel = array_keys($daten[0]);

					foreach ($daten as &$eintrag) {
						$zaehler = 0;
						$neuer_eintrag = array();
						$zusatzdaten = array_shift($zusatz);

						foreach ($schluessel as &$key) {
							if ($zaehler == $position) {
								$neuer_eintrag[$neuer_schluessel] = $zusatzdaten;
							}

							$neuer_eintrag[$key] = $eintrag[$key];

							$zaehler = $zaehler + 1;
						}

						$neue_daten[] = $neuer_eintrag;
					}

					return $neue_daten;
				}

				//gibt einen text mit den tagen an denen die person anwesend ist zurück
				//daten ist das array mit den teilnehmerdaten
				//tage ist ein array mit den wochentagen für die anwesenheit geprüft werden soll
				function anwesenheits_text($conn, $daten, $tage) {
					$anwesenheits_texte = array();

					foreach ($daten as &$eintrag) {
						$teilnehmer_id = $eintrag["id"];
						$text = "";

						foreach ($tage as &$tag) {
							$stmt = mysqli_prepare($conn, "SELECT COUNT(*) FROM " . $tag . " WHERE teilnehmer_id = ?");
							mysqli_stmt_bind_param($stmt, "i", $teilnehmer_id);
							$stmt->execute();
							$anwesend = $stmt->get_result()->fetch_assoc()["COUNT(*)"];

							if ($anwesend > 0) {
								$text = $text . "x";
							} else {
								$text = $text . "o";
							}
						}

						$anwesenheits_texte[] = $text;
					}

					return $anwesenheits_texte;
				}

				//gibt ein array mit allen einzelnen eigenschaften einer tabelle
				function einzelne_eigenschaft($conn, $name, $tabelle) {
					$stmt = mysqli_prepare($conn, "SELECT " . $name . " FROM " . $tabelle);
					$stmt->execute();
					$resultat = $stmt->get_result();
					$eigenschaft = array();

					while ($reihe = $resultat->fetch_assoc()) {
						$eigenschaft[] = $reihe[$name];
					}

					return $eigenschaft;
				}

				$tag_format = "<h5 class='tagesAnsicht' onclick='toggleTag(this)'>▼ %s: %s Tn</h5><div style='display: none;' class='essensListe'><ul><li>%s x Vegetarisch</li><li>%s x Vegan</li></ul><br />außerdem:<ul>%s</ul></div>";
				$sonstige_format = "<li>%s</li>";

				//gibt tagesdaten zurück
				//tag ist der name des tages
				//nicht_woerter enthält wörter in kleinschreibung die ignoriert werden sollen
				function extrahiere_tagesdaten($conn, $tag, $nicht_woerter) {
					$daten = $conn->query("SELECT teilnehmer.essenswuensche AS essenswuensche FROM teilnehmer JOIN " . $tag . " ON teilnehmer.id = " . $tag . ".teilnehmer_id");

					$anzahl = 0;
					$anzahl_vegetarisch = 0;
					$anzahl_vegan = 0;
					$sonstige = array();

					while ($reihe = $daten->fetch_assoc()) {
						$anzahl = $anzahl + 1;
						$essenswunsch = strtolower($reihe["essenswuensche"]);
						if ($essenswunsch == "") {
						} else if ($essenswunsch == "vegetarisch") {
							$anzahl_vegetarisch = $anzahl_vegetarisch + 1;
						} else if ($essenswunsch == "vegan") {
							$anzahl_vegan = $anzahl_vegan + 1;
						} else if (!in_array($essenswunsch, $nicht_woerter)) {
							$sonstige[] = $essenswunsch;
						}
					}

					return array("tag" => $tag, "anzahl" => strval($anzahl), "anzahl_vegetarisch" => strval($anzahl_vegetarisch), "anzahl_vegan" => strval($anzahl_vegan), "sonstige" => $sonstige);
				}

				function erstelle_sonstige_liste($sonstig_format, $sonstige) {
					$liste = "";
					foreach ($sonstige as &$eintrag) {
						$liste = $liste . sprintf($sonstig_format, $eintrag);
					}
					return $liste;
				}

				function erstelle_tagesdaten($conn, $tag_format, $sonstige_format, $tag, $nicht_woerter) {
					$tagesdaten = extrahiere_tagesdaten($conn, $tag, $nicht_woerter);
					return sprintf($tag_format, $tagesdaten["tag"], $tagesdaten["anzahl"], $tagesdaten["anzahl_vegetarisch"], $tagesdaten["anzahl_vegan"], erstelle_sonstige_liste($sonstige_format, $tagesdaten["sonstige"]));
				}
			?>
			<h2>Teilnehmerdaten</h2>
			<p>Alle generellen Teilnehmerdaten. Kein Eintrag bei Ort bedeutet in der Regel Bremen.</p>
			<?php
				$wochentage = array("freitag", "samstag", "sonntag", "montag", "dienstag");
				$resultat = $conn->query("SELECT id, name, geld, essenswuensche, mailadresse, herkunftsort FROM teilnehmer");
				$daten = resultat_zu_array($resultat);

				$daten = reichere_daten_an($daten, 2, anwesenheits_text($conn, $daten, $wochentage), "tage");

				$spalten = array("id" => "ID", "name" => "Name", "tage" => "Tage", "geld" => "Geld", "essenswuensche" => "Essen", "mailadresse" => "Mail", "herkunftsort" => "Ort");
				erstelle_tabelle($spalten, $daten);

			?>

			<h2>Mailadressen</h2>
			<p>Hier alle Mailadressen aller Teilnehmer</p>

			<?php
			 	$mailadressen = einzelne_eigenschaft($conn, "mailadresse", "teilnehmer");
				foreach ($mailadressen as &$mailadresse) {
					echo $mailadresse . ", ";
				}
			?>

			<h2>Teilnehmeranzahl und Essenswünsche</h2>

			<?php
				$nicht_woerter = array("nein", "keine", "nö", "egal", "-");
				echo erstelle_tagesdaten($conn, $tag_format, $sonstige_format, "freitag", $nicht_woerter);
				echo erstelle_tagesdaten($conn, $tag_format, $sonstige_format, "samstag", $nicht_woerter);
				echo erstelle_tagesdaten($conn, $tag_format, $sonstige_format, "sonntag", $nicht_woerter);
				echo erstelle_tagesdaten($conn, $tag_format, $sonstige_format, "montag", $nicht_woerter);
				echo erstelle_tagesdaten($conn, $tag_format, $sonstige_format, "dienstag", $nicht_woerter);
			?>

			<h2>Autos</h2>

			<?php
				$resultat = $conn->query("SELECT teilnehmer.id AS id, teilnehmer.name AS name, teilnehmer.herkunftsort AS herkunftsort, autos.art AS art, autos.nutzung AS nutzung, teilnehmer.mailadresse AS mailadresse, autos.telefonnummer AS telefonnummer FROM teilnehmer JOIN autos WHERE teilnehmer.id = autos.teilnehmer_id");
				$daten = resultat_zu_array($resultat);
				$daten = reichere_daten_an($daten, 2, anwesenheits_text($conn, $daten, $wochentage), "tage");

				$spalten = array("id" => "ID", "name" => "Name", "tage" => "Tage", "herkunftsort" => "Ort", "art" => "Platz", "nutzung" => "Mögliche Fahrer", "mailadresse" => "E-Mail", "telefonnummer" => "Telefon");
				erstelle_tabelle($spalten, $daten);
			?>

			<h2>Fahrer über 25</h2>

			<?php
				$resultat = $conn->query("SELECT id, name, herkunftsort, mailadresse FROM teilnehmer WHERE ueber_25 AND fahrerlaubnis");
				$daten = resultat_zu_array($resultat);
				$daten = reichere_daten_an($daten, 2, anwesenheits_text($conn, $daten, $wochentage), "tage");

				$spalten = array("id" => "ID", "name" => "Name", "tage" => "Tage", "herkunftsort" => "Ort", "mailadresse" => "E-Mail");
				erstelle_tabelle($spalten, $daten);
			?>

			<h2>Fahrer unter 25</h2>

			<?php
				$resultat = $conn->query("SELECT id, name, herkunftsort, mailadresse FROM teilnehmer WHERE NOT ueber_25 AND fahrerlaubnis");
				$daten = resultat_zu_array($resultat);
				$daten = reichere_daten_an($daten, 2, anwesenheits_text($conn, $daten, $wochentage), "tage");

				$spalten = array("id" => "ID", "name" => "Name", "tage" => "Tage", "herkunftsort" => "Ort", "mailadresse" => "E-Mail");
				erstelle_tabelle($spalten, $daten);
			?>

			<h2>Geld gesamt</h2>

			<?php
				$resultat = $conn->query("SELECT SUM(geld) FROM teilnehmer");
				$daten = $resultat->fetch_assoc()["SUM(geld)"];
				echo "<p>" . $daten . "</p>";
			?>

			<h2>Sonstige Infos der Teilnehmer</h2>

			<?php
				$resultat = $conn->query("SELECT id, name, mailadresse, sonstiges FROM teilnehmer WHERE sonstiges IS NOT NULL");
				$daten = resultat_zu_array($resultat);

				$spalten = array("id" => "ID", "name" => "Name", "mailadresse" => "E-Mail", "sonstiges" => "Sonstiges");
				erstelle_tabelle($spalten, $daten);
			?>

			<h2>Marketing</h2>

			<?php
				$resultat = $conn->query("SELECT id, name, mailadresse, marketing FROM teilnehmer WHERE marketing IS NOT NULL");
				$daten = resultat_zu_array($resultat);

				$spalten = array("id" => "ID", "name" => "Name", "mailadresse" => "E-Mail", "marketing" => "Marketing");
				erstelle_tabelle($spalten, $daten);

				include("../mysql/close.php");
			?>
		</article>
	</main>
</body>
</html>
