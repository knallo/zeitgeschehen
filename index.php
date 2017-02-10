<!DOCTYPE HTML>
<html lang="de">
<head>
	<link rel="stylesheet" href="css/style.css" type="text/css" />
	<script src="js/logic.js" type="text/javascript"></script>
	<title>Argumente gegen das Zeitgeschehen 2017</title>
	<meta name="Description" content="Info- und Anmeldeseite für das Argumente gegen das Zeitgeschehen 2017: Vom 02. bis 06. Juni 2017 - also um Pfingsten - wird unter dem Titel 'Argumente gegen das Zeitgeschehen' ein Seminarwochenende in Großgoltern stattfinden. In den mehrstündigen Workshops können dort zwei der insgesamt vier Workshopthemen intensiv diskutiert werden und auch außerhalb der Workshops wird es ausreichend Gelegenheit geben, noch weitere Themen zu diskutieren, die euch unter den Nägeln brennen.">
	<meta name="viewport" content="width=device-width,initial-scale=1">
</head>
<body>
	<?php
		include("includes/header.php");
	?>

	<main>
		<article>
			<?php
				$p = "";
				$workshop = "";
				if (!empty($_GET['p'])) {
					$p = $_GET['p'];
				} elseif (!empty($_GET['workshop'])) {
					$workshop = $_GET['workshop'];
				} else {
					$p = "allgemeines";
					echo 	'<script type="text/javascript">',
					 	'history.replaceState({title: "allgemeines"}, "allgemeines", "?p=allgemeines");',
					 	'</script>';
						
				}
				
				if ($p == "allgemeines" ||
					$p == "programm" ||
					$p == "haus" ||
					$p == "kosten" ||
					$p == "anfahrt" ||
					$p == "anmeldung" ||
					$p == "kontakt" ||
					$p == "impressum") {
					include('content/'.$p.'.php');
					echo 	'<script type="text/javascript">',
						'markMenu("'.$p.'", true);',
						'</script>';
				} elseif ($workshop == "wahl" ||
						$workshop == "auslaender" ||
						$workshop == "armut" ||
						$workshop == "rechteKritisieren") {
					include('content/workshop-'.$workshop.'.php');

					echo '<script type="text/javascript">',
						'markMenu("programm", true);',
						'</script>';
					echo '<br><br><a onclick="loadPage(\'programm\')">zurück zum Programm</a>';
				} elseif ($workshop != "") {
					include('content/workshop-404.inc');
				} else {
					include('content/404.php');
				}
			?>
		</article>
	</main>
</body>
</html>
