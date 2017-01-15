{source}

<?php

if (!empty($_POST['name'])) {
if (!empty($_POST['mi'])) {
$tage = "x";
} else {
$tage = "0";
}
if (!empty($_POST['do'])) {
$tage .= "x";
} else {
$tage .= "0";
}
if (!empty($_POST['fr'])) {
$tage .= "x";
} else {
$tage .= "0";
}
if (!empty($_POST['sa'])) {
$tage .= "x";
} else {
$tage .= "0";
}
if (!empty($_POST['so'])) {
$tage .= "x";
} else {
$tage .= "0";
}

$db = JFactory::getDbo();

$values = array($db->quote($_POST['name']), $db->quote($tage), $db->quote($_POST['geld']), $db->quote($_POST['essen']), $db->quote($_POST['mail']), $db->quote($_POST['fahrt']), $db->quote($_POST['ort']), $db->quote($_POST['sonstso']), $db->quote($_POST['auto']), $db->quote($_POST['AutoGros']), $db->quote($_POST['AutoFahren']), $db->quote($_POST['Telefon']), $db->quote($_POST['fahrer']));



// HIER DIE TECHNIK ZUM EINTRAGEN ;) _____________
// Create a new query object.
$query = $db->getQuery(true);

// Insert columns.
$columns = array('name', 'tage', 'geld', 'essen', 'mail', 'anfahrt', 'ort', 'sonstiges', 'autoda', 'gros', 'recht', 'tel', 'fuhrerschein');


// Prepare the insert query.
$query
->insert($db->quoteName('anmeldung'))
->columns($db->quoteName($columns))
->values(implode(',', $values));

// Set the query using our newly populated query object and execute it.
$db->setQuery($query);
$db->query();
//ENDE DER TECHNIK ZUM EINTRAGEN _____________

 

?>
<div class='alert alert-success'>Deine Anmeldung ist gespeichert. Alle notwendigen Infos schicken wir dir rechtzeitig zu. Wenn es irgendwelche Probleme gibt, melde dich einfach bei <a href='mailto:seminarwochenende&#64;riseup.net'>seminarwochenende&#64;riseup.net</a>.</div>
<?php
}
?>

<script>

if (document.getElementById("gibtAuto").checked == true) {
alert("arg");
}

if ("document.getElementById("gibtKeinAuto").checked == true) {
alert("dsafgd");
}

function test() {
alert("klappt");
}

function autoAnzeigen() {
document.getElementById("Autoinfos").style.display = "block";

}

function autoNichtAnzeigen() {
document.getElementById("Autoinfos").style.display = "none";

}

autoNichtAnzeigen();

 

</script>

<form action="" method="post">
<div class="form-group" style="margin-bottom: 15px;">
<strong><label for="eintrag1">Dein Vorname / Pseudonym</strong></label>
<input type="text" name="name" class="form-control" id="eintrag1" placeholder="Pseudonym" style="width: 95%;" required>
</div>
<div class="form-group" style="margin-bottom: 15px;">
<strong><label for="eintrag9">Aus welchem Ort kommst du (ungefähr)?</label></strong>
<input type="text" name="ort" class="form-control" id="eintrag9" placeholder="Bremen" style="width: 95%;">
</div>
<strong>Fährst du in einer der großen Gruppen mit?</strong>
<label><input type="radio" name="fahrt" value="1">Ich fahre bereits Mittwoch Vormittag und helfe beim Aufbau.</label>
<label><input type="radio" name="fahrt" value="2" checked>Ich fahre mit der Fahrgemeinschaft am Mittwoch per Bahn (16 Uhr, HBF Bremen)</label>
<label><input type="radio" name="fahrt" value="3">Ich fahre nicht in einer der genannten Gruppen mit.</label><br>

<strong>An welchen Tagen kommst du?</strong><br>
(1. Workshopschiene: Donnerstag bis Freitag Vormittag, 2. Workshopschiene: Freitag Nachmittag bis Samstag)
<div style="margin-right:auto;margin-left:auto;margin-bottom:20px;">
<label><input type="checkbox" name="mi" value="true" checked>Mittwoch (Anreise ab 15 Uhr)</label>
<label><input type="checkbox" name="do" value="true" checked>Donnerstag (Christi Himmelfahrt, gesetzlicher Feiertag)</label>
<label><input type="checkbox" name="fr" value="true" checked>Freitag</label>
<label><input type="checkbox" name="sa" value="true" checked>Samstag</label>
<label><input type="checkbox" name="so" value="true" checked>Sonntag (Abreise bis 15 Uhr)</label>
</div>
<div class="form-group" style="margin-bottom: 15px;">
<strong><label for="eintrag2">Wie viel wirst du für Verpflegung und Unterkunft voraussichtlich selbst bezahlen können (weiteres dazu unter <a href="http://www.frühlingsseminar.de/index.php/kosten" target="blank">Kosten</a>)?</label></strong>
<input type="text" name="geld" class="form-control" id="eintrag2" placeholder="60" style="width: 50px; text-align: right;" required> €
</div>
<div class="form-group" style="margin-bottom: 15px;">
<strong><label for="eintrag3">Hast du besondere Essenswünsche (vegan, vegetarisch, Allergien o.ä.)?</label></strong>
<input type="text" name="essen" class="form-control" id="eintrag3" placeholder="hier bitte auch ALLE Allergien etc. angeben!" style="width: 95%;">
</div>

<hr>
<div class="form-group auto" style="margin-bottom: 15px;">
<strong><label for="eintragAuto">Wir brauchen vor Ort wahrscheinlich wieder das ein oder andere Auto samt Fahrer, um zwischendurch Einkäufe u.ä. zu erledigen</label></strong>
<label><input type="radio" name="auto" value="2" id="gibtKeinAuto" checked>Ich habe kein Auto / Ich stelle mein Auto nicht zur Verfügung.</label>
<label><input type="radio" name="auto" value="1" id="gibtAuto">Ich kann ein Auto zur Verfügung stellen</label>

</div><br>
<div id="Autoinfos">
<div class="form-group" style="margin-bottom: 15px;">
<strong><label for="eintragAI">Größe des Autos / Platz im Auto</label></strong>
<input type="text" name="AutoGros" class="form-control" id="eintragAI" placeholder="Opel Astra" style="width: 95%;">
</div>
<div class="form-group" style="margin-bottom: 15px;">
<strong><label for="eintragAF">Wer darf das Auto fahren?</label></strong>
<input type="text" name="AutoFahren" class="form-control" id="eintragAF" placeholder="Nur ich / wg. Vers. nur Menschen über 25J. / alle mit Führerschein / ..." style="width: 95%;">
</div>
<div class="form-group" style="margin-bottom: 15px;">
<strong><label for="eintragTel">Deine Telefonnummer (für Absprache bzgl. Mitfahrmöglichkeiten u.ä.)</label></strong>
<input type="text" name="Telefon" class="form-control" id="eintralTel" placeholder="0173 981276345" style="width: 95%;">
</div>
</div>
<div class="form-group" style="margin-bottom: 15px;">
<strong><label for="eintragFahrer">Würdest du bei Bedarf eine Autofahrt übernehmen und hast einen Führerschein (für einige Autos müssen die Fahrer über 25 sein wegen der Versicherung)?</label></strong>
<label><input type="radio" name="fahrer" value="1">Ja und ich bin über 25J</label>
<label><input type="radio" name="fahrer" value="2">Ja, ich bin aber unter 25J</label>
<label><input type="radio" name="fahrer" value="3" checked>Nein</label>
</div>
<hr>

<div class="form-group" style="margin-bottom: 15px;">
<strong><label for="eintrag4">Deine Mailadresse (für alle weiteren Infos & evtl. Koordination von Fahrgemeinschaften):</label></strong>
<input type="email" name="mail" class="form-control" id="eintrag4" placeholder="example[at]riseup.net" style="width: 95%;" required>
</div>
<div class="form-group" style="margin-bottom: 15px;">
<strong><label for="eintrag4">Sonstige Infos / Fragen? Sollen Fahrtkosten übernommen werden?<br></label></strong>
<textarea name="sonstso" rows="2" style="width:95%;"></textarea>
</div>
<button type="submit" class="btn btn-default" id="test">Jetzt anmelden!</button>
</form>

 <script>

//document.getElementById("Autoinfos").style.display = "none";

</script>

 

{/source}