<!DOCTYPE HTML>
<html>
<head>
	<link rel="stylesheet" href="css/style.css" type="text/css" />
	<script src="js/logic.js" type="text/javascript"></script>
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
						'markMenu("'.$p.'");',
						'</script>';
				} else {
					include('content/404.inc');
				}
			?>
		</article>
	</main>
</body>
</html>
