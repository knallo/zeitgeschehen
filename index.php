<!DOCTYPE HTML>
<html>
<head>
	<link rel="stylesheet" href="css/style.css" type="text/css" />
	<script src="js/logic.js" type="text/javascript"></script>
	<title>Argumente gegen das Zeitgeschehen</title>
	<meta name="Description" content="Info- und Anmeldeseite für das Argumente gegen das Zeitgeschehen 2017">
	<meta name="viewport" content="width=device-width,initial-scale=1">
</head>
<body>
	<?php
		include("includes/header.inc");
	?>

	<main>
		<article>
			<?php
				if (!empty($_GET['p'])) {
					$p = $_GET['p'];
				} elseif (!empty($_GET['workshop'])) {
					$p = "workshop"; // die Variable $p muss in jedem Fall definiert sein, sonst spuckt PHP einen Error aus!
					$workshop = $_GET['workshop'];
				} else {
					$p = "allgemeines";
					echo 	'<script type="text/javascript">',
						'history.replaceState({title: "allgemeines"}, "allgemeines", "?p=allgemeines");',
						'</script>';
				}
				
				if (	$p == "allgemeines" ||
					$p == "programm" ||
					$p == "haus" ||
					$p == "kosten" ||
					$p == "anfahrt" ||
					$p == "anmeldung" ||
					$p == "kontakt") {
					include('content/'.$p.'.inc');
					echo 	'<script type="text/javascript">',
						'markMenu("'.$p.'", true);',
						'</script>';
				} elseif (	$workshop == "wahl" ||
						$workshop == "fluechtlingspolitik" ||
						$workshop == "armut" ||
						$workshop == "rechteKritisieren") {
					include('content/workshop-'.$workshop.'.inc');

					echo '<script type="text/javascript">',
						'markMenu("programm", true);',
						'</script>';
					echo '<br><br><a onclick="loadPage(\'programm\')">zurück zum Programm</a>';
				} else {
					include('content/404.inc');
				}
			?>
		</article>
	</main>
</body>
</html>
