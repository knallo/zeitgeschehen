<h1>
	Anmeldung
</h1>

<h1>Für alle unter 18</h1>
<p>
	Um uns rechtlich abzusichern haben wir einen Muttifbrief geschrieben, den nach Möglichkeit alle Minderjährigen unterschrieben mitbringen sollen. Wenn es dabei Probleme gibt, schreibt uns einfach an. 
</p>

<form action="" method="post">
<p><strong>Dein Vorname / Pseudonym</strong></p>
<input type="text" name="name" placeholder="Pseudonym" required>
<br />
<p><strong>Aus welchem Ort kommst du (ungefähr)?</strong></p>
<input type="text" name="ort" placeholder="Bremen">
<br />
<p><strong>Fährst du in einer der großen Gruppen mit?</strong></p>
<label><input type="radio" name="gruppe" value="1"> Ich fahre bereits Freitag Vormittag und helfe beim Aufbau</label><br />
<label><input type="radio" name="gruppe" value="2" checked> Ich fahre mit der Fahrgemeinschaft am Mittwoch per Bahn (16 Uhr, HBF Bremen)</label><br />
<label><input type="radio" name="gruppe" value="3"> Ich fahre nicht in einer der genannten Gruppen mit</label><br />
<br />
<p><strong>An welchen Tagen kommst du?</strong></p>
<p>(1. Workshopschiene: Samstag bis Sonntag Vormittag, 2. Workshopschiene: Sonntag Nachmittag bis Pfingstmontag)</p>
<label><input type="checkbox" name="tag1" value="true" checked>Freitag</label><br />
<label><input type="checkbox" name="tag2" value="true" checked>Samstag</label><br />
<label><input type="checkbox" name="tag3" value="true" checked>Sonntag</label><br />
<label><input type="checkbox" name="tag4" value="true" checked>Pfingstmontag</label><br />
<label><input type="checkbox" name="tag5" value="true" checked>Dienstag</label><br />
<br />
<p><strong>Wie viel wirst du für Verpflegung und Unterkunft voraussichtlich selbst bezahlen können (weiteres dazu unter <a href="?p=kosten">Kosten</a>)?</strong></p>
<input type="text" name="geld" placeholder="60" style="width: 50px; text-align: right;" required> €<br />
<br />
<p><strong>Hast du besondere Essenswünsche (vegan, vegetarisch, Allergien o.ä.)?</strong></p>
<input type="text" name="essen" placeholder="hier bitte auch ALLE Allergien etc. angeben!"><br />
<br />
<p><strong>Wir brauchen vor Ort wahrscheinlich wieder das eine oder andere Auto samt Fahrer, um zwischendurch Einkäufe u.ä. zu erledigen.</strong></p>
<label><input type="radio" name="autoBesitzen" value="2" checked>Ich habe kein Auto / Ich stelle mein Auto nicht zur Verfügung</label><br />
<label><input type="radio" name="autoBesitzen" value="1">Ich kann ein Auto zur Verfügung stellen</label><br />
<br />

<span id="autofrage">
	<p><strong>Größe des Autos / Platz im Auto</strong></p>
	<input type="text" name="autoGroesse" placeholder="Opel Astra"><br />
	<br />
	<p><strong>Wer darf das Auto fahren?</strong></p>
	<input type="text" name="autoVersicherung" placeholder="Nur ich / wg. Vers. nur Menschen über 25J. / alle mit Führerschein / ..."><br />
	<br />
	<p><strong>Deine Telefonnummer (für Absprache bzgl. Mitfahrmöglichkeiten u.ä.)</strong></p>
	<input type="text" name="telefon" placeholder="0173 891276345">
	<br />
</span>

<p><strong>Würdest du bei Bedarf eine Autofahrt übernehmen und hast einen Führerschein (für einige Autos müssen die Fahrer über 25 sein wegen der Versicherung)?</strong></p>
<label><input type="radio" name="autoFahren" value="1">Ja und ich bin über 25J</label><br />
<label><input type="radio" name="autoFahren" value="2">Ja, ich bin aber unter 25J</label><br />
<label><input type="radio" name="autoFahren" value="3" checked>Nein</label><br />
<br />
<p><strong>Deine Mailadresse (für alle weiteren Infos & evtl. Koordination von Fahrgemeinschaften):</strong></p>
<input type="text" name="mail" placeholder="example[at]riseup.net" required><br />
<br />
<p><strong>Sonstige Infos / Fragen? Sollen Fahrtkosten übernommen werden?</strong></p>
<textarea name="sonstso" rows="2" style="width:95%;"></textarea><br />
<br />
<input type="submit" name="absenden" value="Jetzt anmelden!">

</form>
