<?php
	include("../mysql/connect.php");

	header("Location: ../datenbank/index.php");

	$kuerzel = $_GET["kuerzel"];

	//der tatsächliche insert
	$stmt = mysqli_prepare($conn, "DELETE FROM workshops WHERE kuerzel = ?");
	mysqli_stmt_bind_param($stmt, "s", $kuerzel);
	$stmt->execute();

	include("../mysql/close.php");
?>
