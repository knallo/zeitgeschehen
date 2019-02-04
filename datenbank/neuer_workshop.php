<!DOCTYPE HTML>
<html>
<head>
	<link rel="stylesheet" href="../css/style.css" type="text/css" />
	<script src="../js/logic.js" type="text/javascript"></script>
	<title>Workshop am Argumente gegen das Zeitgeschehen</title>
	<meta name="Description" content="Intern: Anmeldungen zum AgZ 2017">
	<meta name="viewport" content="width=device-width,initial-scale=1">
</head>
<body>
	<main>
		<article class="anmeldungen">
			<a href="../datenbank/index.php" style="font-size: 0.8em"><- Zurück zur Übersichtsseite</a>
			<h1>Neuer Workshp</h1>
			<iframe style="display:none;" name="target"></iframe>
    	<form action="./schreibe_neuen_workshop.php" method="post" target="target">
				<label>Kürzel (max 10 Buchstaben)</label><input type='text' maxlength='10' name='kuerzel' required />
				<label>Titel</label><input type='text' name='titel' required />
				<label>Untertitel</label><input type='text' name='untertitel' />
				<label>Einführungstext</label><textarea name='einfuehrungstext' rows=5 required ></textarea>
				<input type='radio' name='schiene' value='1' id='ist_erste_schiene' checked required /><label>Ist in der ersten Schiene.</label><br />
				<input type='radio' name='schiene' value='2' id='ist_zweite_schiene' required /><label>Ist in der zweiten Schiene.</label>
      <input type="submit" value="Schreibe neuen Workshop">
    </form>
		</article>
	</main>
</body>
</html>
