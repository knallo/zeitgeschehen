<h1>
	Anmeldung
</h1>

<?php
	$gespeichert = false;
	if (!empty($_POST['absenden'])) {
		if (!empty($_POST['name'])
		&& strlen($_POST['geld']) > 0
		&& !empty($_POST['mail'])) {
			if (!empty($_POST['tag1']) ||
				!empty($_POST['tag2']) ||
				!empty($_POST['tag3']) ||
				!empty($_POST['tag4']) ||
				!empty($_POST['tag5'])) {

				// An welchen Tagen bist du da?
				if (!empty($_POST['tag1'])) {
					$tage = "x";
				} else {
					$tage = "0";
				}
				if (!empty($_POST['tag2'])) {
					$tage .= "x";
				} else {
					$tage .= "0";
				}
				if (!empty($_POST['tag3'])) {
					$tage .= "x";
				} else {
					$tage .= "0";
				}
				if (!empty($_POST['tag4'])) {
					$tage .= "x";
				} else {
					$tage .= "0";
				}
				if (!empty($_POST['tag5'])) {
					$tage .= "x";
				} else {
					$tage .= "0";
				}
				include("../../zeitgeschehen/mysql/connect.php");

				// prepare and bind
				$stmt = mysqli_prepare($conn, "INSERT INTO anmeldung (name, tage, geld, essen, mail, ort, marketing, sonstiges, autoda, gros, recht, tel, fuhrerschein) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
				mysqli_stmt_bind_param($stmt, "sssssssssssss", $sql_name, $sql_tage, $sql_geld, $sql_essen, $sql_mail, $sql_ort, $sql_marketing, $sql_sonstiges, $sql_autoda, $sql_gros, $sql_recht, $sql_tel, $sql_fuhrerschein);

				// set parameters and execute
				$sql_name = $_POST['name'];
				$sql_tage = $tage;
				$sql_geld = $_POST['geld'];
				$sql_essen = $_POST['essen'];
				$sql_mail = $_POST['mail'];
				$sql_ort = $_POST['ort'];
				$sql_marketing = $_POST['marketing'];
				$sql_sonstiges = $_POST['sonstso'];
				$sql_autoda = $_POST['autoBesitzen'];
				$sql_gros = $_POST['autoGroesse'];
				$sql_recht = $_POST['autoVersicherung'];
				$sql_tel = $_POST['telefon'];
				$sql_fuhrerschein = $_POST['autoFahren'];
				mysqli_stmt_execute($stmt);

				mysqli_stmt_close($stmt);
				mysqli_close($conn);

				$gespeichert = true;
				
				include("content/angemeldet.php");
			} else {
				echo "<div class='alert'>Du musst angeben, an welchen Tagen du da sein wirst!</div>";
			}
		} else {
			echo "<div class='alert'>Dein Name, die Höhe deines Eigenbeitrags, deine Mailadresse und die Tage an denen du da sein wirst sind Pflichtfelder.</div>";
		}
	}

	function setValue($fieldName) {
		global $gespeichert; // sorgt für eine in der Funktion lokale Instanz der Variable gespeichert
		if (!empty($_POST[$fieldName])
			&& !$gespeichert) {
			echo " value=\"" . $_POST[$fieldName] . "\" ";
		}
	}

	function makeCheckbox($fieldName, $default) {
		global $gespeichert;
		$checked = false;
		if (!empty($_POST[$fieldName])
			&& !$gespeichert) {
			$checked = true;
		}
		if (empty($_POST['absenden']) && $default ||
			$gespeichert && $default) {
			$checked = true;
		}

		echo "<input type=\"checkbox\" name=\"" . $fieldName . "\" value=\"true\"";
		if ($checked) {
			echo " checked";
		}
		echo " />";
	}

	function makeRadiobutton($custom, $fieldName, $fieldValue, $default) {
		global $gespeichert;
		$checked = false;
		if (!empty($_POST[$fieldName]) &&
			!$gespeichert &&
			$_POST[$fieldName] == $fieldValue) {
			$checked = true;
		}
		if (empty($_POST['absenden']) && $default ||
			$gespeichert && $default) {
			$checked = true;
		}

		if (!$custom) {
			echo "<input type=\"radio\" name=\"" . $fieldName . "\" value=\"" . $fieldValue . "\"";
		}
		if ($checked) {
			echo " checked";
		}
		if (!$custom) {
			echo " />";
		}
	}

?>

<form action="" method="post">
<p><strong>Dein Name*</strong></p>
<input type="text" name="name" placeholder="Name" <?php setValue("name"); ?> required />
<br />
<p><strong>Aus welchem Ort kommst du?</strong></p>
<input type="text" name="ort" placeholder="Bremen" <?php setValue("ort"); ?> />
<br />
<p><strong>An welchen Tagen kommst du?*</strong></p>
<p>(1. Workshopschiene: Samstag bis Sonntag Vormittag, 2. Workshopschiene: Sonntag Nachmittag bis Pfingstmontag)</p>
<label><?php makeCheckbox("tag1", false); ?> Freitag</label><br />
<label><?php makeCheckbox("tag2", false); ?> Samstag</label><br />
<label><?php makeCheckbox("tag3", false); ?> Sonntag</label><br />
<label><?php makeCheckbox("tag4", false); ?> Pfingstmontag</label><br />
<label><?php makeCheckbox("tag5", false); ?> Dienstag</label><br />
<br />
<p><strong>Wie viel wirst du für Verpflegung und Unterkunft voraussichtlich selbst bezahlen können (weiteres dazu unter <a title="Kosten" onclick="loadPage('kosten')" class="jsLink">Kosten</a><noscript><a title="Kosten" href="?p=kosten">Kosten</a></noscript>)?*</strong></p>
<input type="number" name="geld" placeholder="65" style="width: 60px; text-align: right;" <?php setValue("geld"); ?> required /> €<br />
<br />
<p><strong>Hast du besondere Essenswünsche (vegan, vegetarisch, Allergien o.ä.)?</strong></p>
<input type="text" name="essen" placeholder="hier bitte auch ALLE Allergien etc. angeben!" <?php setValue("essen"); ?>/><br />
<br />
<p><strong>Wir brauchen vor Ort wahrscheinlich wieder das eine oder andere Auto samt Fahrer, um zwischendurch Einkäufe u.ä. zu erledigen.</strong></p>
<label><input type="radio" name="autoBesitzen" value="2" id="besitztKeinAuto" onclick="autofrage()" <?php makeRadiobutton(true, "autoBesitzen", "2", true); ?> /> Ich habe kein Auto / Ich stelle mein Auto nicht zur Verfügung</label><br />
<label><input type="radio" name="autoBesitzen" value="1" id="besitztAuto" onclick="autofrage()" <?php makeRadiobutton(true, "autoBesitzen", "1", false); ?> /> Ich kann ein Auto zur Verfügung stellen</label><br />
<br />

<div id="autofrage" class="hidden">
	<p><strong> Größe des Autos / Platz im Auto</strong></p>
	<input type="text" name="autoGroesse" placeholder="Opel Astra" <?php setValue("autoGroesse"); ?>/><br />
	<br />
	<p><strong> Wer darf das Auto fahren?</strong></p>
	<input type="text" name="autoVersicherung" placeholder="Nur ich / wg. Vers. nur Menschen über 25J. / alle mit Führerschein / ..." <?php setValue("autoVersicherung"); ?>/><br />
	<br />
	<p><strong> Deine Telefonnummer (für Absprache bzgl. Mitfahrmöglichkeiten u.ä.)</strong></p>
	<input type="tel" name="telefon" placeholder="0173 891276345" <?php setValue("telefon"); ?>/>
	<br />
</div>

<script>
	autofrage();
</script>

<p><strong>Würdest du bei Bedarf eine Autofahrt übernehmen und hast einen Führerschein (für einige Autos müssen die Fahrer über 25 sein wegen der Versicherung)?</strong></p>
<label><?php makeRadiobutton(false, "autoFahren", "1", false); ?> Ja und ich bin über 25J</label><br />
<label><?php makeRadiobutton(false, "autoFahren", "2", false); ?> Ja, ich bin aber unter 25J</label><br />
<label><?php makeRadiobutton(false, "autoFahren", "3", true); ?> Nein</label><br />
<br />
<p><strong>Deine Mailadresse (für alle weiteren Infos & evtl. Koordination von Fahrgemeinschaften):*</strong></p>
<input type="email" name="mail" placeholder="example[at]riseup.net" <?php setValue("mail"); ?> required /><br />
<br />
<p><strong>Wie hast du vom Argumente gegen das Zeitgeschehen erfahren?</strong></p>
<textarea name="marketing" rows="2"><?php
	if (!empty($_POST["marketing"])
		&& !$gespeichert) {
		echo $_POST["marketing"];
	}
?></textarea><br />
<br />
<p><strong>Sonstige Infos / Fragen? Sollen Fahrtkosten übernommen werden?</strong></p>
<textarea name="sonstso" rows="2"><?php
	if (!empty($_POST["sonstso"])
		&& !$gespeichert) {
		echo $_POST["sonstso"];
	}
?></textarea><br />
<br />
<input type="submit" name="absenden" value="Jetzt anmelden!" />

</form>
