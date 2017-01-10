<!DOCTYPE HTML>
<html>
<head>
	<link rel="stylesheet" href="css/style.css" type="text/css" />
	<script src="js/jquery.js" type="text/javascript"></script>
</head>
<body>
	<?php
		include("includes/header.inc");
	?>

	<main>
		<?php
			//Die richtige Seite öffnen
			if (!empty($_GET['p'])) {
				$p = $_GET['p'];
			} else {
				$p = "allgemeines";
			}
				if ($p == "allgemeines" ||
				$p == "programm" ||
				$p == "haus" ||
				$p == "kosten" ||
				$p == "anfahrt" ||
				$p == "anmeldung") {
				include("content/".$p.".inc");
			} else {
				include("content/404.inc");
			}
		?>
	</main>
	<?php
		include("includes/side.inc");
	?>
</body>
</html>
