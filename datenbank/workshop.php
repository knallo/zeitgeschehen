<!DOCTYPE HTML>
<html>
<head>
	<link rel="stylesheet" href="../css/style.css" type="text/css" />
	<script src="../js/logic.js" type="text/javascript"></script>
	<title>Workshop am Argumente gegen das Zeitgeschehen</title>
	<meta name="Description" content="Intern: Anmeldungen zum AgZ 2017">
	<meta name="viewport" content="width=device-width,initial-scale=1">
</head>
<body>
  <?php
    include("../mysql/connect.php");

    $kuerzel = $_GET["kuerzel"];

		$stmt = $conn->prepare("SELECT * FROM workshops WHERE kuerzel = ?");
		mysqli_stmt_bind_param($stmt, "s", $kuerzel);
		$stmt->execute();

		$workshop = $stmt->get_result()->fetch_assoc();
  ?>
	<main>
		<article class="anmeldungen">
			<a href="../datenbank/index.php" style="font-size: 0.8em"><- Zurück zur Übersichtsseite</a>
			<h1><?php echo $workshop["titel"]; ?></h1>
    	<form action="./schreibe_workshop.php?kuerzel=<?php echo $kuerzel;?>" method="post">
			<?php
				echo "<label>Kürzel (max 10 Buchstaben)</label><input type='text' maxlength='10' name='kuerzel' value='" . $workshop["kuerzel"] . "' required />";
				echo "<label>Titel</label><input type='text' name='titel' value='" . $workshop["titel"] . "' required />";
				echo "<label>Untertitel</label><input type='text' name='untertitel' value='" . $workshop["untertitel"] . "' />";
				echo "<label>Einführungstext</label><textarea name='einfuehrungstext' rows=5 required >" . $workshop["einfuehrungstext"] . "</textarea>";

				if (boolval($workshop["ist_erste_schiene"])) {
					echo "<input type='radio' name='schiene' value='1' id='ist_erste_schiene' checked required /><label>Ist in der ersten Schiene.</label><br />";
					echo "<input type='radio' name='schiene' value='2' id='ist_zweite_schiene' required /><label>Ist in der zweiten Schiene.</label>";
				} else {
					echo "<input type='radio' name='schiene' value='1' id='ist_erste_schiene' required /><label>Ist in der ersten Schiene.</label><br />";
					echo "<input type='radio' name='schiene' value='2' id='ist_zweite_schiene' checked required /><label>Ist in der zweiten Schiene.</label>";
				}
			?>
      <input type="submit" value="Schreibe neue Workshopdaten">
    </form>
		</article>
	</main>
</body>
</html>
