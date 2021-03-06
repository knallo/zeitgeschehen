<!DOCTYPE HTML>
<html lang="de">
<head>
	<link rel="stylesheet" href="css/style.css" type="text/css" />
	<script src="js/logic.js" type="text/javascript"></script>
	<title>
			<?php
				include("mysql/index.php");

				$is_first = false;
				if (!empty($_GET['p'])) {
					$p = $_GET['p'];
				} else {
					$p = "allgemeines";
					$is_first = true;
				}

				if (in_array($p, $kuerzel)) {
					echo ucwords($titel[$p]);
				} else {
					echo ucwords($p);
				}
			?>
		- AgdZ<?php echo date("y", $start); ?></title>
	<link rel="image_src" href="https://zeitgeschehen.net/uploads/screenshot.png" / >
	<meta property="og:image" content="https://zeitgeschehen.net/uploads/screenshot.png"/>
	<?php echo $description; ?>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<!-- Matomo -->
<script type="text/javascript">
  var _paq = window._paq || [];
  /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//www.zeitgeschehen.net/matomo/";
    _paq.push(['setTrackerUrl', u+'matomo.php']);
    _paq.push(['setSiteId', '1']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Matomo Code -->
</head>
<body>
	<?php
		include("includes/logo.php");
	?>
	<main>
			<?php
				include("includes/header.php");
			?>
		<article>
			<?php
				if ($is_first) {
					echo '<script type="text/javascript">',
					 	'history.replaceState({title: "allgemeines"}, "allgemeines", "?p=allgemeines");',
					 	'</script>';
				}
				if (in_array($p, $pages)) {
					include('content/'.$p.'.php');
					echo 	'<script type="text/javascript">',
						'markMenu("'.$p.'", true);',
						'</script>';
				} elseif (in_array($p, $kuerzel)) {
					$_POST["titel"] = $p;
					include('content/workshop.php');
					echo '<script type="text/javascript">',
						'markMenu("programm", true);',
						'</script>';
					echo '<br><br><a href="?p=programm">zurück zum Programm</a>';
				} else {
					include('content/404.php');
				}
			?>
		</article>
	</main>
</body>
</html>
