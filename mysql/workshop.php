<?php

  include('mysql/connect.php');

  function get_workshop($titel, $conn) {
    $stmt = $conn->prepare("SELECT titel, untertitel, einfuehrungstext, ist_erste_schiene, ist_zweite_schiene FROM workshops WHERE kuerzel = ?");
    $stmt->bind_param("s", $titel);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
  }

  $workshopzeiten = $conn->query("SELECT * FROM workshops_zeit")->fetch_assoc();
  $zeittext_erste_schiene_vorlage = "<p>%s von %s Uhr bis %s Uhr<br />sowie von %s Uhr bis %s Uhr, und<br />%s von %s Uhr bis %s Uhr.</p>";
  $zeittext_zweite_schiene_vorlage = "<p>%s von %s Uhr bis %s Uhr, und<br />%s von %s Uhr bis %s Uhr<br />sowie von %s Uhr bis %s Uhr.</p>";
  $wochentage = array("Pfingstmontag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag", "Sonntag");

  $zeittext_erste_schiene = sprintf($zeittext_erste_schiene_vorlage,
    $wochentage[date('N', strtotime($workshopzeiten['erste_schiene_anfang'])) - 1],
    date('H:i', strtotime($workshopzeiten['erste_schiene_anfang'])),
    date('H:i', strtotime($workshopzeiten['erste_schiene_erstes_zwischenende'])),
    date('H:i', strtotime($workshopzeiten['erste_schiene_erster_zwischenanfang'])),
    date('H:i', strtotime($workshopzeiten['erste_schiene_zweites_zwischenende'])),
    $wochentage[date('N', strtotime($workshopzeiten['erste_schiene_zweiter_zwischenanfang'])) - 1],
    date('H:i', strtotime($workshopzeiten['erste_schiene_zweiter_zwischenanfang'])),
    date('H:i', strtotime($workshopzeiten['erste_schiene_ende']))
  );
  $zeittext_zweite_schiene = sprintf($zeittext_zweite_schiene_vorlage,
    $wochentage[date('N', strtotime($workshopzeiten['zweite_schiene_anfang'])) - 1],
    date('H:i', strtotime($workshopzeiten['zweite_schiene_anfang'])),
    date('H:i', strtotime($workshopzeiten['zweite_schiene_erstes_zwischenende'])),
    $wochentage[date('N', strtotime($workshopzeiten['zweite_schiene_erster_zwischenanfang'])) - 1],
    date('H:i', strtotime($workshopzeiten['zweite_schiene_erster_zwischenanfang'])),
    date('H:i', strtotime($workshopzeiten['zweite_schiene_zweites_zwischenende'])),
    date('H:i', strtotime($workshopzeiten['zweite_schiene_zweiter_zwischenanfang'])),
    date('H:i', strtotime($workshopzeiten['zweite_schiene_ende']))
  );

  $results = $conn->query("SELECT kuerzel FROM workshops");
  $kuerzel = array();
  while ($row = mysqli_fetch_assoc($results)) {
    $kuerzel[] = $row["kuerzel"];
  }
?>
