<h1>
	Anmeldung
</h1>
<form action="content/angemeldet.php" method="post">
<p><strong>Dein Name*</strong></p>
<input type="text" name="name" placeholder="Name" required />
<br />
<p><strong>Aus welchem Ort kommst du?</strong></p>
<input type="text" name="herkunftsort" placeholder="Bremen" />
<br />
<p><strong>An welchen Tagen kommst du?*</strong></p>
<p>(1. Workshopschiene: Samstag bis Sonntag Vormittag, 2. Workshopschiene: Sonntag Nachmittag bis Pfingstmontag)</p>
<input type="checkbox" name="freitag" onchange="mindestens_ein_tag()" value="Ja" required/><label>Freitag</label><br />
<input type="checkbox" name="samstag" onchange="mindestens_ein_tag()" value="Ja" required/><label>Samstag</label><br />
<input type="checkbox" name="sonntag" onchange="mindestens_ein_tag()" value="Ja" required/><label>Sonntag</label><br />
<input type="checkbox" name="montag" onchange="mindestens_ein_tag()" value="Ja" required/><label>Pfingstmontag</label><br />
<input type="checkbox" name="dienstag" onchange="mindestens_ein_tag()" value="Ja" required/><label>Dienstag</label><br />
<script>
	mindestens_ein_tag();
</script>
<br />
<p><strong>Wie viel wirst du für Verpflegung und Unterkunft voraussichtlich selbst bezahlen können (weiteres dazu unter <a title="Kosten" onclick="loadPage('kosten')" class="jsLink">Kosten</a><noscript><a title="Kosten" href="?p=kosten">Kosten</a></noscript>)?*</strong></p>
<input type="number" min="0" name="geld" placeholder="65" style="width: 60px; text-align: right;" required /> €<br />
<br />
<p><strong>Hast du besondere Essenswünsche (vegan, vegetarisch, Allergien o.ä.)?</strong></p>
<input type="text" name="essenswuensche" placeholder="hier bitte auch ALLE Allergien etc. angeben!" /><br />
<br />
<p><strong>Wir brauchen vor Ort wahrscheinlich wieder das eine oder andere Auto samt Fahrer, um zwischendurch Einkäufe u.ä. zu erledigen.</strong></p>
<input type="radio" name="hatauto" value="2" id="besitztKeinAuto" onclick="autofrage()" checked /><label>Ich habe kein Auto / Ich stelle mein Auto nicht zur Verfügung</label><br />
<input type="radio" name="hatauto" value="1" id="besitztAuto" onclick="autofrage()" /><label>Ich kann ein Auto zur Verfügung stellen</label><br />
<br />

<div id="autofrage" class="hidden">
	<p><strong>Größe des Autos / Platz im Auto</strong></p>
	<input type="text" name="art" placeholder="Opel Astra" /><br />
	<br />
	<p><strong>Wer darf das Auto fahren?</strong></p>
	<input type="text" name="nutzung" placeholder="Nur ich / wg. Vers. nur Menschen über 25J. / alle mit Führerschein / ..." /><br />
	<br />
	<p><strong>Deine Telefonnummer (für Absprache bzgl. Mitfahrmöglichkeiten u.ä.)</strong></p>
	<input type="tel" name="telefonnummer" placeholder="0173 891276345" />
	<br />
</div>

<p><strong>Würdest du bei Bedarf eine Autofahrt übernehmen und hast einen Führerschein (für einige Autos müssen die Fahrer über 25 sein wegen der Versicherung)?</strong></p>
<input type="radio" name="fahrerlaubnis" value="1" required /><label>Ja und ich bin über 25J</label><br />
<input type="radio" name="fahrerlaubnis" value="2" required /><label>Ja, ich bin aber unter 25J</label><br />
<input type="radio" name="fahrerlaubnis" value="3" required checked /><label>Nein</label><br />
<br />
<p><strong>Deine Mailadresse (für alle weiteren Infos & evtl. Koordination von Fahrgemeinschaften):*</strong></p>
<input type="email" name="mailadresse" placeholder="example[at]riseup.net" required /><br />
<br />
<p><strong>Wie hast du vom Argumente gegen das Zeitgeschehen erfahren?</strong></p>
<input type="text" name="marketing" placeholder="Flyer / Facebook / ...">
<br />
<p><strong>Sonstige Infos / Fragen? Sollen Fahrtkosten übernommen werden?</strong></p>
<textarea name="sonstiges" rows="2"></textarea><br />
<br />
<input type="submit" name="absenden" value="Jetzt anmelden!" />

</form>
