<?php
	include("../mysql/connect.php");

	header("Location: ../datenbank/index.php");

	$kuerzel = $_POST["kuerzel"];
	$titel = $_POST["titel"];
	$untertitel = (!empty($_POST["untertitel"]) ? $_POST["untertitel"] : NULL);
	$einfuehrungstext = $_POST["einfuehrungstext"];
	if ($_POST["schiene"] == "1") {
		$ist_erste_schiene = True;
		$ist_zweite_schiene = False;
	} else {
		$ist_erste_schiene = False;
		$ist_zweite_schiene = True;
	}

	$stmt = mysqli_prepare($conn, "INSERT INTO workshops VALUES (?, ?, ?, ?, ?, ?)");
	mysqli_stmt_bind_param($stmt, "ssssii", $titel, $untertitel, $einfuehrungstext, $kuerzel, $ist_erste_schiene, $ist_zweite_schiene);
	$stmt->execute();

	include("../mysql/close.php");
?>
