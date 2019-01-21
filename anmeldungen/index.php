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
			<?php
			if (!empty($_GET['rm'])) {
				if ($_GET['bestatigt'] == "false") {
					echo "<form action='' method='get'>
						<input type='hidden' name='rm' value='true' />
						<input type='hidden' name='dbid' value='" . $_GET['dbid'] . "' />
						<input type='hidden' name='bestatigt' value='true' />
						<input type='submit' value='Jetzt die Anmeldung mit der id " . $_GET['uiid'] . " löschen' />
					</form>
					<br />";
				} else if ($_GET['bestatigt'] == "true") {

					echo "Löschung wurde bestätigt";
					
					include("../mysql/connect.php");
					$sql = "UPDATE anmeldung SET abgesagt = 1 WHERE id = '" . $_GET['dbid'] . "'";
					if ($conn->query($sql) === TRUE) {
					    echo "<div class='alert'>Der Eintrag wurde erfolgreich gelöscht</div>";
					} else {
					    echo "<div class='alert'>Ein Systemfehler ist aufgetreten. Bitte kontaktiere einen Admin und gib ihm die folgende Fehlermeldung: " . $conn->error . "</div>";
					}
				}
			}
			?>
			<p>Hier sind alle Anmeldungen aufgelistet (die neuesten zuerst):</p>
			<p>Ein nicht ausgefüllter Ort bedeutet idR Bremen.</p>
			<br />
			<table class="tableAnmeldungen">
				<tr>
					<th width="5%">id</th>
					<th>Name</th>
					<th>Tage*</th>
					<th>Geld</th>
					<th>Essen</th>
					<th>Mail</th>
					<th>Ort</th>
					<th>löschen</th>
				</tr>

				<?php
				$essenProTag = array("", "", "", "", ""); // Die Essenswünsche der Tn für jeden Tag, an dem sie da sind (vegan und vegetarisch werden extra abgefragt)
				$vegan = array(0,0,0,0,0); // Vegan-Esser pro Tag
				$vegetarisch = array(0,0,0,0,0); // vegetarische Esser pro Tag
				$anw = array(0,0,0,0,0); // Tn, die insgesamt pro Tag da sind
				$money = 0; // wie viel zählbares Geld (wenn nur eine Zahl eingegeben wurde) bekommen wir wahrscheinlich?
				$otherMoney = ""; // alles nicht-zählbare Geld als String
				$mails = ""; // Alle Mailadressen
				$autos = ""; // Die Tabelle unter "Autos"
				$fahrer = ""; // Die Tabelle unter "Fahrer"
				$marketing = ""; //Marketinginfos
				$sonstigeInfos = ""; // Die Tabelle unter "sonstige Infos"
				$eigeneLeute = 0; // Die Leute, die sich explizit als Referent oder Orga angemeldet haben.
				$z1 = 0;
				$z2 = 0;
				$z3 = 0;
				$z4 = 0;
				$z5 = 0;
				$i = 0;

				// Connect to database
				include("../mysql/connect.php");

				$sql = "SELECT id, name, tage, geld, essen, mail, ort, autoda, gros, recht, fuhrerschein, tel, marketing, sonstiges FROM anmeldung WHERE abgesagt != 1 ORDER BY id DESC";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
				    while($row = $result->fetch_assoc()) {

				    	$id = mysqli_num_rows($result) - $i;
						$i++;

				    	/* Haupttabelle */ 

				        if ($z1 == 1) {
							echo "<tr class='bgHighlight'>";
							$z1 = 0;
						} else {
							echo "<tr>";
							$z1 = 1;
						}
						echo "<td>$id</td>";
						echo "<td>" . $row['name'] . "</td>";
						echo "<td>" . $row['tage'] . "</td>";
						echo "<td>" . $row['geld'] . "</td>";
						echo "<td>" . $row['essen'] . "</td>";
						echo "<td><a href='mailto:" . $row['mail'] . "'>" . $row['mail'] . "</a></td>";
						echo "<td>" . $row['ort'] . "</td>";
						echo "<td style='text-align: center;'><a href='?rm=true&dbid=" . $row['id'] . "&uiid=" . $id . "&bestatigt=false'>X</a></td>";
						echo "</tr>";

						/* Geld */

						if (!empty($row['mail'])) {
							$mails .= $row['mail'] . ", ";
						}
						if (is_numeric($row['geld'])) {
							$money += $row['geld'];
						} elseif (!empty($row['geld'])) {
							$otherMoney .= "+ ".$row['geld']."<br>";
						}

						/* Anwesenheit */

						for ($n=0; $n<=4; $n++) {
							if (substr($row['tage'], $n, 1) == "x") {
								$anw[$n]++;
								if (!empty($row['essen']) && 
									strcasecmp($row['essen'], "nein") != 0 && 
									strcasecmp($row['essen'], "keine") != 0 && 
									strcasecmp($row['essen'], "nö") != 0 && 
									strcasecmp($row['essen'], "Egal") != 0 &&
									strcasecmp($row['essen'], "-") != 0) {
									if ($row['essen'] == "Vegetarisch" || 
										$row['essen'] == "vegetarisch" || 
										$row['essen'] == "Vegetarisch " || 
										$row['essen'] == "vegetarisch ") {
										$vegetarisch[$n]++;
									} else if ($row['essen'] == "Vegan" || 
										$row['essen'] == "vegan" || 
										$row['essen'] == "Vegan " || 
										$row['essen'] == "vegan ") {
										$vegan[$n]++;
									} else {
										$essenProTag[$n] .= "<li>".$row['essen']."</li>";
									}
								}
							}
						}

						/* Autos */
						if ($row['autoda'] == "1") {
							if ($z2 == 1) {
								$autos .= "<tr class='bgHighlight'>";
								$z2 = 0;
							} else {
								$autos .= "<tr>";
								$z2 = 1;
							}
							$autos .= "<td>$id</td>";
							$autos .= "<td>" . $row['name'] . "</td>";
							$autos .= "<td>" . $row['tage'] . "</td>";
							$autos .= "<td>" . $row['ort'] . "</td>";
							$autos .= "<td>" . $row['gros'] . "</td>";
							$autos .= "<td>" . $row['recht'] . "</td>";
							$autos .= "<td><a href='mailto:" . $row['mail'] . "'>" . $row['mail'] . "</a></td>";
							$autos .= "<td>" . $row['tel'] . "</td>";
							$autos .= "</tr>";
						}

						/* Fahrer */

						if ($row['fuhrerschein'] != "3") {
							if ($z3 == 1) {
								$fahrer .= "<tr class='bgHighlight'>";
								$z3 = 0;
							} else {
								$fahrer .= "<tr>";
								$z3 = 1;
							}
							$fahrer .= "<td>$id</td>";
							$fahrer .= "<td>" . $row['name'] . "</td>";
							$fahrer .= "<td>" . $row['tage'] . "</td>";
							$fahrer .= "<td>" . $row['ort'] . "</td>";
							$fahrer .= "<td>";
							if ($row['fuhrerschein'] == "2") {
								$fahrer .= "Nein";
							} elseif ($row['fuhrerschein'] == "1") {
								$fahrer .= "Ja";
							} else {
								$fahrer .= "ERROR";
							} 
							$fahrer .= "</td>";
							$fahrer .= "<td><a href='mailto:" . $row['mail'] . "'>" . $row['mail'] . "</a></td>";
							$fahrer .= "</tr>";
						}

						/* Sonstige Infos */

						if (!empty($row['sonstiges'])) {
							if ($z4 == 1) {
								$sonstigeInfos .= "<tr class='bgHighlight'>";
								$z4 = 0;
							} else {
								$sonstigeInfos .= "<tr>";
								$z4 = 1;
							}
							$sonstigeInfos .= "<td>$id</td>";
							$sonstigeInfos .= "<td>" . $row['name'] . "</td>";
							$sonstigeInfos .= "<td><a href='mailto:" . $row['mail'] . "'>" . $row['mail'] . "</a></td>";
							$sonstigeInfos .= "<td>" . $row['sonstiges'] . "</td>";
						}

						/* Marketing */

						if (!empty($row['marketing'])) {

							if (strcasecmp($row['marketing'], "referent") != 0 &&
								strcasecmp($row['marketing'], "orga") != 0) {
								if ($z5 == 1) {
									$marketing .= "<tr class='bgHighlight'>";
									$z5 = 0;
								} else {
									$marketing .= "<tr>";
									$z5 = 1;
								}
								$marketing .= "<td>$id</td>";
								$marketing .= "<td>" . $row['name'] . "</td>";
								$marketing .= "<td>" . $row['marketing'] . "</td>";
							} else {
								$eigeneLeute++;
							}
						}
				    }
				}
				$conn->close();
				?>
			</table>

			<br />
			<p>(Davon sind mindestens <?php echo $eigeneLeute; ?> Leute unmittelbar von uns)</p>
			<h4>Alle Mailadressen:</h4>

			<?php
			echo $mails;
			?>
			<br />
			<br />
			<h2>Anwesenheiten und Essenswünsche</h2>

			<?php
			$tag = array("Freitag", "Samstag", "Sonntag", "Montag", "Dienstag");
			for ($i=0; $i<5; $i++) {
				echo "<h5 class='tagesAnsicht' onclick='toggleTag(this)'>▼ $tag[$i]: $anw[$i] Tn</h5>";
				echo "<div style='display: none;' class='essensListe'>";
					echo "<ul>";
						echo "<li>$vegetarisch[$i] x Vegetarisch</li>";
						echo "<li>$vegan[$i] x Vegan</li>";
					echo "</ul>";
					echo "<br />außerdem:";
					echo "<ul>";
						echo $essenProTag[$i];
					echo "</ul>";
				echo "</div>";
			}
			?>

			<br />
			<br />
			<h2>Autos</h2>

			<table>
				<tr>
					<th>id</th>
					<th>Name</th>
					<th>Tage*</th>
					<th>Stadt</th>
					<th>Platz</th>
					<th>Mögliche Fahrer</th>
					<th>Mailadresse</th>
					<th>Telefonnummer</th>
				</tr>

				<?php
				echo $autos;
				?>

			</table>

			<br />
			<br />
			<h2>Fahrer</h2>

			<table>
				<tr>
					<th>id</th>
					<th>Name</th>
					<th>Tage*</th>
					<th>Stadt</th>
					<th>Über 25?</th>
					<th>Mailadresse</th>
				<?php
					echo $fahrer;
				?>
			</table>
			<br />
			<br />
			<h2>Geld</h2>

			<?php
			echo "Geld insgesamt: ".$money."€";
			if (!empty($otherMoney)) {
				echo " plus <br>".$otherMoney;
			}
			?>

			<br />
			<br />
			<h2>Sonstige Infos der Tn</h2>

			<table>
				<tr>
					<th>id</th>
					<th>Name</th>
					<th>Mailadresse</th>
					<th>Kommentar</th>
				</tr>
				<?php
					echo $sonstigeInfos;
				?>
			</table>

			<br />
			<br />
			<h2>Marketinginfos</h2>

			<table>
				<tr>
					<th>id</th>
					<th>Name</th>
					<th>geworben durch</th>
				</tr>
				<?php
					echo $marketing;
				?>
			</table>

			<br />
			<br />

			<hr>

			*) Bei den Anwesenheits-Tagen steht ein "x" für "ist da" und ein "0" für "ist nicht da"; die erste Ziffer steht für den ersten Tag, die zweite für den zweiten usw.
			00xxx würde also bspw. heißen: Nur an den letzten drei Tagen da.
		</article>
	</main>
</body>
</html>
