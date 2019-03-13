<?php
  include("./connect.php");

  header("Location: ../datenbank/teilnehmer.php");

  $ids = array_map('intval', explode(',', $_POST["loesch_id"]));
  $id = 0;
  $stmt = mysqli_prepare($conn, "DELETE FROM teilnehmer WHERE id = ?");
  mysqli_stmt_bind_param($stmt, "i", $id);

  foreach ($ids as &$temp) {
    $id = $temp;
    $stmt->execute();
  }

  include("./close.php")
?>
