<?php
  include('mysql/connect.php');

  $results = $conn->query("SELECT titel, kuerzel FROM workshops");
  $kuerzel = array();
  $titel = array();
  while ($row = mysqli_fetch_assoc($results)) {
    $kuerzel[] = $row["kuerzel"];
    $titel[$row["kuerzel"]] = $row["titel"];
  }

  $start_end = $conn->query("SELECT anfangsdatum, enddatum FROM allgemein")->fetch_assoc();
  $start = strtotime($start_end['anfangsdatum']);
  $end = strtotime($start_end['enddatum']);
  $monate = array("Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember");

  $description_vorlage = "<meta name='Description' content='Info- und Anmeldeseite für das Argumente gegen das Zeitgeschehen %s: Vom %s bis %s %s %s - also um Pfingsten - wird unter dem Titel \'Argumente gegen das Zeitgeschehen\' ein Seminarwochenende in Großgoltern stattfinden. In den mehrstündigen Workshops können dort zwei der insgesamt vier Workshopthemen intensiv diskutiert werden und auch außerhalb der Workshops wird es ausreichend Gelegenheit geben, noch weiter Themen zu diskutieren, die euch unter den Nägeln brennen.'";
  $description = sprintf($description_vorlage,
    date('y', $start),
    date('d.', $start),
    date('d.', $end),
    $monate[date('m', $end) - 1],
    date('y', $start)
  );

  $pages = array("allgemeines", "programm", "haus", "kosten", "anfahrt", "anmeldung", "kontakt", "impressum");
?>
