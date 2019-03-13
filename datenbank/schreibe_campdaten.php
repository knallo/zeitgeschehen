<?php
	include("../mysql/connect.php");

	header("Location: ../datenbank/index.php");

  $anfangsdatum = date("Y-m-d", strtotime($_POST["anfangsdatum"]));
  $enddatum = date("Y-m-d", strtotime($_POST["enddatum"]));
  $haus_oeffnungszeit = date("Y-m-d H:i:s", strtotime($_POST["haus_oeffnungszeit"]));
  $haus_schliesszeit = date("Y-m-d H:i:s", strtotime($_POST["haus_schliesszeit"]));
  $kosten_untere_schranke = intval($_POST["kosten_untere_schranke"]);
  $kosten_obere_schranke = intval($_POST["kosten_obere_schranke"]);

  //vorherige daten löschen
  $conn->query("DELETE FROM allgemein");

	//der tatsächliche insert
	$stmt = mysqli_prepare($conn, "INSERT INTO allgemein VALUES (?, ?, ?, ?, ?, ?)");
	mysqli_stmt_bind_param($stmt, "ssssii", $anfangsdatum, $enddatum, $haus_oeffnungszeit, $haus_schliesszeit, $kosten_untere_schranke, $kosten_obere_schranke);
	$stmt->execute();
  echo $conn->error;

	include("../mysql/close.php");
?>
