<!DOCTYPE HTML>
<html>
<head>
	<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body>
	<?php
		include("includes/header.inc");
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
					$p == "anfahrt" ||
					$p == "anmeldung") {
					include("content/".$p.".inc");
				} else {
					include("content/404.inc");
				}
			?>
		</content>
		<sidebar>
			<?php
				include("includes/side.inc");
			?>
		</sidebar>
	</main>
	<?php
		include("includes/footer.inc");
	?>
</body>
</html>