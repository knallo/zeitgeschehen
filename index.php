<!DOCTYPE HTML>
<html lang="de">
<head>
	<link rel="stylesheet" href="css/style.css" type="text/css" />
	<script src="js/logic.js" type="text/javascript"></script>
	<title>
			<?php
				$p = "";
				$workshop = "";
				$isFirstPage = false;
				$isWorkshop = false;
				$isInvalidWorkshop = false;
				$isValidPage = false;
				if (!empty($_GET['p'])) {
					$p = $_GET['p'];
				} elseif (!empty($_GET['workshop'])) {
					$workshop = $_GET['workshop'];
				} else {
					$p = "allgemeines";
					$isFirstPage = true;
				}

				if ($p == "allgemeines" ||
					$p == "programm" ||
					$p == "haus" ||
					$p == "kosten" ||
					$p == "anfahrt" ||
					$p == "anmeldung" ||
					$p == "kontakt" ||
					$p == "impressum") {
					$isValidPage = true;
					echo ucwords($p);
				} elseif ($workshop == "trump" ||
					$workshop == "klima" ||
					$workshop == "bge" ||
					$workshop == "kritik" ||
					$workshop == "demonstrationsfreiheit") {
					$isWorkshop = true;
					echo "Workshop: ";
					if ($workshop == "trump") {
						echo "Populismus und Trump";
					} elseif ($workshop == "klima") {
						echo "Klimawandel und Energiewende";
					} elseif ($workshop == "bge") {
						echo "Bedingungsloses Grundeinkommen";
					} elseif ($workshop == "kritik") {
						echo "Kritik - Wie geht das?";
					} elseif ($workshop == "demonstrationsfreiheit") {
						echo "Über die Freiheit zum Demonstrieren";
					}
				} elseif ($workshop != "") {
					$isInvalidWorkshop = true;
					$isWorkshop = true;
					echo "Workshop nicht gefunden";
				}
			?>
		- Argumente gegen das Zeitgeschehen 2018</title>
	<link rel="image_src" href="https://zeitgeschehen.net/uploads/screenshot.png" / >
	<meta property="og:image" content="https://zeitgeschehen.net/uploads/screenshot.png"/>
	<meta name="Description" content="Info- und Anmeldeseite für das Argumente gegen das Zeitgeschehen 2018: Vom 18. bis 22. Mai 2018 - also um Pfingsten - wird unter dem Titel 'Argumente gegen das Zeitgeschehen' ein Seminarwochenende in Großgoltern stattfinden. In den mehrstündigen Workshops können dort zwei der insgesamt vier Workshopthemen intensiv diskutiert werden und auch außerhalb der Workshops wird es ausreichend Gelegenheit geben, noch weitere Themen zu diskutieren, die euch unter den Nägeln brennen.">
	<meta name="viewport" content="width=device-width,initial-scale=1">

	<script type="text/javascript">
	  var _paq = _paq || [];
	  _paq.push(['trackPageView']);
	  _paq.push(['enableLinkTracking']);
	  (function() {
	    var u="//piwik.zeitgeschehen.net/";
	    _paq.push(['setTrackerUrl', u+'piwik.php']);
	    _paq.push(['setSiteId', '1']);
	    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
	    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
	  })();
	</script>
	<noscript><p><img src="//piwik.zeitgeschehen.net/piwik.php?idsite=1" style="border:0;" alt="" /></p></noscript>
</head>
<body>
	<logo>
		<img src="img/AgdZ_Logo_web_mit_date.png" alt="Argumente gegen das Zeitgeschehen - 18.-22. Mai 2018" />
		<p>
			Eine Veranstaltung des <a href="http://arbeitskreisaufloesen.blogsport.eu" target="blank">Arbeitskreis Auflösen</a>
		</p>
	</logo>
	<main>
		<header id="header">
			<?php
				include("includes/header.php");
			?>
		</header>
		<article>
			<?php
				if ($isFirstPage) {
					echo '<script type="text/javascript">',
					 	'history.replaceState({title: "allgemeines"}, "allgemeines", "?p=allgemeines");',
					 	'</script>';
				}	
				if ($isValidPage) {
					include('content/'.$p.'.php');
					echo 	'<script type="text/javascript">',
						'markMenu("'.$p.'", true);',
						'</script>';
				} elseif ($isInvalidWorkshop) {
					include('content/workshop-404.php');
				} elseif ($isWorkshop) {
					include('content/workshop-'.$workshop.'.php');
				} else {
					include('content/404.php');
				}
				if ($isWorkshop) {
					echo '<script type="text/javascript">',
						'markMenu("programm", true);',
						'</script>';
					echo '<br><br><a href="?p=programm#hinweis">zurück zum Programm</a>';
				}
			?>
		</article>
	</main>
</body>
</html>
