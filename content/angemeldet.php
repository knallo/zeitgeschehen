<?php
	include("../mysql/connect.php");

	//insert into teilnehmer
	//puereite text parameter vor
	$text_parameter_namen = array("name", "essenswuensche", "mailadresse", "herkunftsort", "marketing", "sonstiges");
	$parameter = array();

	function lese_text_param($name, &$parameter) {
		if (!empty($_POST[$name])) {
			$parameter[$name] = $_POST[$name];
		} else {
			$parameter[$name] = NULL;
		}
	}

	foreach ($text_parameter_namen as &$name) {
		lese_text_param($name, $parameter);
	}

	//bereite geld parameter vor
	$parameter["geld"] = intval($_POST['geld']);

	//bereite fahrerlaubnis parameter vor
	$fahrerlaubnis = intval($_POST['fahrerlaubnis']);
	if ($fahrerlaubnis == 1) {
		$parameter["ueber_25"] = True;
		$parameter["fahrerlaubnis"] = True;
	} else if ($fahrerlaubnis == 2) {
		$parameter["ueber_25"] = False;
		$parameter["fahrerlaubnis"] = True;
	} else {
		$parameter["ueber_25"] = False;
		$parameter["fahrerlaubnis"] = False;
	}

	//der tatsächliche insert
	$stmt = mysqli_prepare($conn, "INSERT INTO teilnehmer (name, geld, essenswuensche, ueber_25, fahrerlaubnis, mailadresse, herkunftsort, marketing, sonstiges) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
	mysqli_stmt_bind_param($stmt, "sssiissss", $parameter["name"], $parameter["geld"], $parameter["essenswuensche"], $parameter["ueber_25"], $parameter["fahrerlaubnis"], $parameter["mailadresse"], $parameter["herkunftsort"], $parameter["marketing"], $parameter["sonstiges"]);
	$stmt->execute();

	//ermittle id für spätere inserts
	$teilnehmer_id = intval($conn->insert_id);

	//insert für verschiedene tage
	$tage = array("freitag", "samstag", "sonntag", "montag", "dienstag");

	function insert_into_tag($teilnehmer_id, $tag, $conn) {
		$stmt = mysqli_prepare($conn, "INSERT INTO " . $tag . " VALUES (?)");
		mysqli_stmt_bind_param($stmt, "i", $teilnehmer_id);
		$stmt->execute();
	}

	function check_checkbox($teilnehmer_id, $tag) {
		if (isset($_POST[$tag]) && $_POST[$tag] == "Ja") {
			return True;
		} else {
			return False;
		}
	}

	foreach ($tage as &$tag) {
		if (check_checkbox($teilnehmer_id, $tag)) {
			insert_into_tag($teilnehmer_id, $tag, $conn);
		}
	}

	//insert into auto
	if (intval($_POST['hatauto']) == 1) {
		$text_parameter_namen = array("art", "nutzung", "telefonnummer");
		$parameter = array();

		foreach ($text_parameter_namen as &$name) {
			lese_text_param($name, $parameter);
		}

		$stmt = mysqli_prepare($conn, "INSERT INTO autos VALUES (?, ?, ?, ?)");
		mysqli_stmt_bind_param($stmt, "sssi", $parameter["art"], $parameter["nutzung"], $parameter["telefonnummer"], $teilnehmer_id);
		$stmt->execute();
	}
?>
<head>
	<link rel="stylesheet" href="css/style.css" type="text/css" />
	<script src="js/logic.js" type="text/javascript"></script>
	<title>Angemeldet</title>
</head>
<body>
	Deine Anmeldung ist gespeichert. Falls du noch unter 18 Jahre alt bist, bring bitte einen <a href="/uploads/elternbrief.pdf" target="blank">Elternbrief</a> unterschrieben zur Fahrt mit.
	Alle notwendigen Infos schicken wir dir rechtzeitig per Mail zu.
	Wenn es irgendwelche Probleme gibt oder du noch Fragen hast, melde dich einfach bei <a href="mailto:zeitgeschehen@riseup.net">zeitgeschehen&#64;riseup.net</a>. <br />

	<a href="../index.php">Zurück zur Website</a>
</body>
<?php
	include("../mysql/close.php");
?>
