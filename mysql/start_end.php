<?php
  include('mysql/connect.php');

  $start_end = $conn->query("SELECT anfangsdatum, enddatum FROM allgemein")->fetch_assoc();
  $start = strtotime($start_end['anfangsdatum']);
  $end = strtotime($start_end['enddatum']);
  $monate = array("Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember");
?>
