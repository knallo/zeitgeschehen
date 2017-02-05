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
	<?php
		include("../includes/header.php");
	?>
	<main>
		<article width="90%">
			<p>Hier sind alle Anmeldungen aufgelistet (die neuesten zuerst):</p>
			<br />
			<table class="tableAnmeldungen">
				<tr>
					<th>id</th>
					<th>Name</th>
					<th>Tage*</th>
					<th>Geld</th>
					<th>Essen</th>
					<th>Mail</th>
					<th>Anf.</th>
					<th>Ort</th>
				</tr>

				<?php
				$essenProTag = array("", "", "", "", "");
				$vegan = array(0,0,0,0,0);
				$vegetarisch = array(0,0,0,0,0);
				$anw = array(0,0,0,0,0);
				$anfahrt2 = "";
				$money = "";
				$omoney = "";
				$mails = "";
				$z = 0;
				$i = 0;

				// Connect to database
				include("../mysql/connect.php");
				//$sqlCount = "SELECT COUNT(*) FROM anmeldung AS count WHERE abgesagt != 1";
				//$anzAnm = mysql_fetch_assoc($sqlCount);
				//echo $anzAnm['count'];

				$sql = "SELECT name, tage, geld, essen, mail, anfahrt, ort, autoda, gros, recht, fuhrerschein FROM anmeldung WHERE abgesagt != 1 ORDER BY id DESC";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
				    while($row = $result->fetch_assoc()) {
				        if ($z == 1) {
							echo "<tr style='background-color: #ddd;'>";
							$z = 0;
						} else {
							echo "<tr>";
							$z = 1;
						}
						echo "<td>";
						$ii = mysqli_num_rows($result);
						$ii = $ii - $i;
						echo $ii . "</td>";
						$i++;
						echo "<td>" . $row['name'] . "</td>";
						echo "<td>" . $row['tage'] . "</td>";
						echo "<td>" . $row['geld'] . "</td>";
						echo "<td>" . $row['essen'] . "</td>";
						echo "<td>" . $row['mail'] . "</td>";
						echo "<td>" . $row['anfahrt'] . "</td>";
						echo "<td>" . $row['ort'] . "</td>";
						echo "</tr>";

						/* Geld */
						if (!empty($row['mail'])) {
							$mails .= $row['mail'] . ", ";
						}
						if ($row['anfahrt'] == "2") {
							$anfahrt2 .= $row['mail'].", ";
						}
						if (is_numeric($row['geld'])) {
							$money += $row['geld'];
						} elseif (!empty($row['geld'])) {
							$omoney .= "+ ".$row['geld']."<br>";
						}

						/* Anwesenheit */

						for ($n=0; $n<=4; $n++) {
							if (substr($row['tage'], $n, 1) == "x") {
								$anw[$n]++;
								if (!empty($row['essen']) && 
									strcasecmp($row['essen'], "nein") != 0 && 
									strcasecmp($row['essen'], "keine") != 0 && 
									strcasecmp($row['essen'], "nö") != 0 && 
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
				    }
				}
				$conn->close();
				?>
			</table>

				
<?php
/*				for ($i=0;$i<count($result);$i++) {
					if ($z == 1) {
						echo "<tr style='background-color: #ddd;'>";
						$z = 0;
					} else {
						echo "<tr>";
						$z = 1;
					}
					echo "<td>"; $ii=count($result)-$i; echo $ii . "</td>";
					echo "<td>" . $result[$i]->name . "</td>";
					echo "<td>" . $result[$i]->tage . "</td>";
					echo "<td>" . $result[$i]->geld . "</td>";
					echo "<td>" . $result[$i]->essen . "</td>";
					echo "<td>" . $result[$i]->mail . "</td>";
					echo "<td>" . $result[$i]->anfahrt . "</td>";
					echo "<td>" . $result[$i]->ort . "</td>";
					echo "</tr>";

					/* Geld */
/*					if (!empty($result[$i]->mail)) {
						$mails .= $result[$i]->mail . ", ";
					}
					if ($result[$i]->anfahrt == "2") {
						$anfahrt2 .= $result[$i]->mail.", ";
					}
					if (is_numeric($result[$i]->geld)) {
						$money += $result[$i]->geld;
					} elseif (!empty($result[$i]->geld)) {
						$omoney .= "+ ".$result[$i]->geld."<br>";
					}

					/* Anwesenheit */

	/*				for ($n=0; $n<=4; $n++) {
						if (substr($result[$i]->tage, $n, 1) == "x") {
							$anw[$n]++;
							if (!empty($result[$i]->essen) && 
								strcasecmp($result[$i]->essen, "nein") != 0 && 
								strcasecmp($result[$i]->essen, "keine") != 0 && 
								strcasecmp($result[$i]->essen, "nö") != 0 && 
								strcasecmp($result[$i]->essen, "-") != 0) {
								if ($result[$i]->essen == "Vegetarisch" || 
									$result[$i]->essen == "vegetarisch" || 
									$result[$i]->essen == "Vegetarisch " || 
									$result[$i]->essen == "vegetarisch ") {
									$vegetarisch[$n]++;
								} else if ($result[$i]->essen == "Vegan" || 
									$result[$i]->essen == "vegan" || 
									$result[$i]->essen == "Vegan " || 
									$result[$i]->essen == "vegan ") {
									$vegan[$n]++;
								} else {
									$essenProTag[$n] .= "<li>".$result[$i]->essen."</li>";
								}
							}
						}
					}
				}
				echo "</table>";
				echo "<br><h4>Alle Mailadressen:</h4>";
				echo $mails;
				echo "<br><br><h4>Mailadressen für die gemeinsame Anfahrt nachmittags aus Bremen: </h4>";
				echo $anfahrt2;

				$tag = array("Mittwoch", "Donnerstag", "Freitag", "Samstag", "Sonntag");
				echo "<br><br><h2>Anwesenheiten und Essenswünsche</h2>";
				echo "<table>";
				for ($i=0; $i<5; $i++) {
				// echo "<tr><td style='padding-right: 15px;'>$tag[$i]</td><td>".$anw[$i]."</td></tr>";
				echo "<h5 id='tag$i' style='cursor: pointer; background-color: #ddd; padding: 4px; border-radius: 3px;'>▼ $tag[$i], $anw[$i]</h5>";

				echo "<ul id='essen$i' style='display: none;'>";
				echo "<li>$vegetarisch[$i] x Vegetarisch</li>";
				echo "<li>$vegan[$i] x Vegan</li>";
				echo "<br>außerdem:";
				echo $essenProTag[$i];
				echo "</ul>";

				}
				echo "</table>";

				/* Autofragen */

/*				echo "<br><br><h2>Autos</h2>";
				?>
				<table width="100%"><tr><th>Name</th><th>Tage*</th><th>Stadt</th><th>Platz</th><th>Mögliche Fahrer</th><th>Mailadresse</th></tr>

				<?php

				$z = 1;

				for ($i=0;$i<count($result);$i++) {

				if ($result[$i]->autoda == "1") {

				if ($z == 1) {

				echo "<tr style='background-color: #ddd;'>";

				$z = 0;

				} else {

				echo "<tr>";

				$z = 1;

				}

				echo "<td>" . $result[$i]->name . "</td>";

				echo "<td>" . $result[$i]->tage . "</td>";

				echo "<td>" . $result[$i]->ort . "</td>";

				echo "<td>" . $result[$i]->gros . "</td>";

				echo "<td>" . $result[$i]->recht . "</td>";

				echo "<td>" . $result[$i]->mail . "</td>";

				echo "</tr>";

				}

				}

				?>

				</table>

				<br><br><h2>Fahrer</h2>

				<table width="100%"><tr><th>Name</th><th>Tage*</th><th>Stadt</th><th>Über 25?</th><th>Mailadresse</th>

				<?php

				$z = 1;

				for ($i=0;$i<count($result);$i++) {

				if ($result[$i]->fuhrerschein != "3") {

				if ($z == 1) {

				echo "<tr style='background-color: #ddd;'>";

				$z = 0;

				} else {

				echo "<tr>";

				$z = 1;

				}

				echo "<td>" . $result[$i]->name . "</td>";

				echo "<td>" . $result[$i]->tage . "</td>";

				echo "<td>" . $result[$i]->ort . "</td>";

				echo "<td>";
				if ($result[$i]->fuhrerschein == "2") { echo "Nein"; }
				if ($result[$i]->fuhrerschein == "1") { echo "Ja"; } 
				if ($result[$i]->fuhrerschein == "3") { echo "FEHLER"; } 
				echo "</td>";

				echo "<td>" . $result[$i]->mail . "</td>";

				echo "</tr>";

				}

				}

				echo "</table>";

				echo "<br><br><h2>Geld</h2>";
				echo "Geld insgesamt: ".$money."€ plus <br>".$omoney;
*/
				?>


				<script>

				$(document).ready(function(){

				    $("#tag0").click(function(){

				        $("#essen0").toggle();

				    });

				    $("#tag1").click(function(){

				        $("#essen1").toggle();

				    });

				    $("#tag2").click(function(){

				        $("#essen2").toggle();

				    });

				    $("#tag3").click(function(){

				        $("#essen3").toggle();

				    });

				    $("#tag4").click(function(){

				        $("#essen4").toggle();

				    })

				});

				</script>

				<hr>

				*) Bei den Anwesenheits-Tagen steht ein "x" für "ist da" und ein "0" für "ist nicht da"; die erste Ziffer steht für den ersten Tag, die zweite für den zweiten usw.
				00xxx würde also bspw. heißen: Nur an den letzten drei Tagen da.
		</article>
	</main>
</body>
</html>
