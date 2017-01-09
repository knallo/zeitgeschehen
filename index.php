<!DOCTYPE HTML>
<html>
<head>
	<!-- <link rel="stylesheet" href="/css/style.css" type="text/css" />  Datei muss noch erstellt werden -->

</head>
<body>
	<?php
		//include("header.inc");
	?>

	<main>
		<content>
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
					$p == "abfahrt" ||
					$p == "anmeldung") {
					include("content/".$p.".inc");
				} else {
					include("content/404.inc");
				}
			?>
		</content>
		<sidebar>
			<?php
				//include("includes/sidebar.inc");
			?>
		</sidebar>
	</main>
</body>
</html>