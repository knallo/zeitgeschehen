<?php

  include('mysql/start_end.php');

  $zahlwoerter = array("null", "eins", "zwei", "drei", "vier", "fünf", "sechs", "sieben", "acht", "neun");
  $wochentage = array("Pfingstmontag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag", "Sonntag");
  function vor_oder_nachmittag($stunde) {
    if ($stunde < 12) {
      echo "vormittag";
    } else if ($stunde == 12) {
      echo "mittag";
    } else {
      echo "nachmittag";
    }
  }

  $anzahl_workshops = $conn->query("SELECT COUNT(*) FROM workshops")->fetch_row()[0];

  $workshopzeiten = $conn->query("SELECT * FROM workshops_zeit")->fetch_assoc();
  // annahme ist hier dass beide schienen die gleiche form haben, und das alle slots gleich lang sind.
  $slotlaenge = date('H', strtotime($workshopzeiten['erste_schiene_erstes_zwischenende'])) - date('H', strtotime($workshopzeiten['erste_schiene_anfang']));
  $anzahl_erste = $conn->query("SELECT COUNT(*) FROM workshops WHERE ist_erste_schiene = TRUE")->fetch_row()[0];
  $anzahl_zweite = $conn->query("SELECT COUNT(*) FROM workshops WHERE ist_zweite_schiene = TRUE")->fetch_row()[0];

  $zeittext_erste_schiene_vorlage = "<p>%s von %s Uhr bis %s Uhr<br />sowie von %s Uhr bis %s Uhr, und<br />%s von %s Uhr bis %s Uhr.</p>";
  $zeittext_zweite_schiene_vorlage = "<p>%s von %s Uhr bis %s Uhr, und<br />%s von %s Uhr bis %s Uhr<br />sowie von %s Uhr bis %s Uhr.</p>";

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

  $results = $conn->query("SELECT titel, untertitel, kuerzel, ist_erste_schiene, ist_zweite_schiene FROM workshops");
  $link_einfuerungstext_vorlage = "<a title='Ankündiger zum Workshop \'%s\'' href='?p=%s'>Einführungstext</a>";
  $workshops_erste_schiene = array();
  $workshops_zweite_schiene = array();
  $kuerzel = array();
  while ($row = mysqli_fetch_assoc($results)) {
    $workshop = array();
    $workshop[] = $row["titel"];
    $workshop[] = $row["untertitel"];
    $workshop[] = sprintf($link_einfuerungstext_vorlage, $row["titel"], $row["kuerzel"]);
    $kuerzel[] = $row["kuerzel"];
    if ($row["ist_erste_schiene"] == True) {
      $workshops_erste_schiene[] = $workshop;
    } else {
      $workshops_zweite_schiene[] = $workshop;
    }
  }
?>
