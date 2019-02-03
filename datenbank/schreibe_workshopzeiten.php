<?php
	include("../mysql/connect.php");

	$schluessel = array("erste_schiene_anfang", "erste_schiene_erstes_zwischenende", "erste_schiene_erster_zwischenanfang", "erste_schiene_zweites_zwischenende", "erste_schiene_zweiter_zwischenanfang", "erste_schiene_ende", "zweite_schiene_anfang", "zweite_schiene_erstes_zwischenende", "zweite_schiene_erster_zwischenanfang", "zweite_schiene_zweites_zwischenende", "zweite_schiene_zweiter_zwischenanfang", "zweite_schiene_ende");
	$zeiten = array();

	foreach ($schluessel as &$key) {
		$zeiten[$key] = date("Y-m-d H:i:s", strtotime($_POST[$key]));
	}

  //vorherige daten löschen
  $conn->query("DELETE FROM workshops_zeit");

	//der tatsächliche insert
	$stmt = mysqli_prepare($conn, "INSERT INTO workshops_zeit VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
	mysqli_stmt_bind_param($stmt, "ssssssssssss", $zeiten["erste_schiene_anfang"], $zeiten["erste_schiene_erstes_zwischenende"], $zeiten["erste_schiene_erster_zwischenanfang"], $zeiten["erste_schiene_zweites_zwischenende"], $zeiten["erste_schiene_zweiter_zwischenanfang"], $zeiten["erste_schiene_ende"], $zeiten["zweite_schiene_anfang"], $zeiten["zweite_schiene_erstes_zwischenende"], $zeiten["zweite_schiene_erster_zwischenanfang"], $zeiten["zweite_schiene_zweites_zwischenende"], $zeiten["zweite_schiene_zweiter_zwischenanfang"], $zeiten["zweite_schiene_ende"]);
	$stmt->execute();

	include("../mysql/close.php");
?>
