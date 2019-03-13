<?php
  include("./connect.php");

  header("Location: ../datenbank/teilnehmer.php");

  $ids = array_map('intval', explode(',', $_POST["intern_id"]));
  $id = 0;
  $stmt = mysqli_prepare($conn, "INSERT INTO intern VALUES (?)");
  mysqli_stmt_bind_param($stmt, "i", $id);

  foreach ($ids as &$temp) {
    $id = $temp;
    $stmt->execute();
  }

  include("./close.php")
?>
