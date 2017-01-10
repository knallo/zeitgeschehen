<!DOCTYPE HTML>
<html>
<head>
<<<<<<< HEAD
	<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body>
	<?php
		include("includes/header.inc");
=======
	<!-- <link rel="stylesheet" href="/css/style.css" type="text/css" />  Datei muss noch erstellt werden -->

</head>
<body>
	<?php
		//include("header.inc");
>>>>>>> 4c92eea365a200deb918b8191fba6a3dd40a6da7
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
<<<<<<< HEAD
					$p == "anfahrt" ||
=======
					$p == "abfahrt" ||
>>>>>>> 4c92eea365a200deb918b8191fba6a3dd40a6da7
					$p == "anmeldung") {
					include("content/".$p.".inc");
				} else {
					include("content/404.inc");
				}
			?>
		</content>
		<sidebar>
			<?php
<<<<<<< HEAD
				include("includes/side.inc");
			?>
		</sidebar>
	</main>
	<?php
		include("includes/footer.inc");
	?>
=======
				//include("includes/sidebar.inc");
			?>
		</sidebar>
	</main>
>>>>>>> 4c92eea365a200deb918b8191fba6a3dd40a6da7
</body>
</html>