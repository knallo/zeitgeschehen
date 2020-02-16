<?php
	include("../mysql/connect.php");

	header("Location: ../datenbank/index.php");

	$kuerzel = $_POST["kuerzel"];
	$titel = $_POST["titel"];
	$untertitel = (!empty($_POST["untertitel"]) ? $_POST["untertitel"] : NULL);
	$einfuehrungstext = $_POST["einfuehrungstext"];
	$ist_erste_schiene = False;
	$ist_zweite_schiene = False;
	if ($_POST["erste_schiene"] == "on") {
		$ist_erste_schiene = True;
	}
       	if ($_POST["zweite_schiene"] == "on" {
		$ist_zweite_schiene = True;
	}

	$stmt = mysqli_prepare($conn, "INSERT INTO workshops VALUES (?, ?, ?, ?, ?, ?)");
	mysqli_stmt_bind_param($stmt, "ssssii", $titel, $untertitel, $einfuehrungstext, $kuerzel, $ist_erste_schiene, $ist_zweite_schiene);
	$stmt->execute();

	include("../mysql/close.php");
?>
