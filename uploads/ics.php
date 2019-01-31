<?php
  include('../mysql/connect.php');

  $wochentage = array("Pfingstmontag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag", "Sonntag");
  $hauszeiten = $conn->query("SELECT haus_oeffnungsdatum, haus_schliessdatum FROM allgemein")->fetch_assoc();
  $workshopzeiten = $conn->query("SELECT * FROM workshops_zeit")->fetch_assoc();

  //workshops
  $results = $conn->query("SELECT titel, kuerzel, ist_erste_schiene, ist_zweite_schiene FROM workshops");
  $workshops_erste_schiene = array();
  $workshops_zweite_schiene = array();
  $kuerzel = array();
  while ($row = mysqli_fetch_assoc($results)) {
    $workshop = array();
    $workshop[] = $row["titel"];
    $workshop[] = $row["kuerzel"];
    if ($row["ist_erste_schiene"] == True) {
      $workshops_erste_schiene[] = $workshop;
    } else {
      $workshops_zweite_schiene[] = $workshop;
    }
  }

  $intro_string = "BEGIN:VCALENDAR\r\nVERSION:2.0\r\nX-WR-CALNAME:Argumente gegen das Zeitgeschehen %s\r\nCALSCALE:GREGORIAN\r\n";
  $timezone_string = "BEGIN:VTIMEZONE\r\nTZID:Europe/Berlin\r\nTZURL:http://tzurl.org/zoneinfo-outlook/Europe/Berlin\nX-LIC-LOCATION:Europe/Berlin\r\nBEGIN:DAYLIGHT\r\nTZOFFSETFROM:+0100\r\nTZOFFSETTO:+0200\r\nTZNAME:CEST\r\nDTSTART:19700329T020000\r\nRRULE:FREQ=YEARLY;BYMONTH=3;BYDAY=-1SU\r\nEND:DAYLIGHT\r\nBEGIN:STANDARD\r\nTZOFFSETFROM:+0200\r\nTZOFFSETTO:+0100\r\nTZNAME:CET\r\nDTSTART:19701025T030000\r\nRRULE:FREQ=YEARLY;BYMONTH=10;BYDAY=-1SU\r\nEND:STANDARD\r\nEND:VTIMEZONE\r\n";
  $whole_event_string = "BEGIN:VEVENT\r\nDTSTAMP:%s\r\nDTSTART;VALUE=DATE:%s\r\nDTEND;VALUE=DATE:%s\r\nSUMMARY:Argumente gegen das Zeitgeschehen %s\r\nURL:https://www.zeitgeschehen.net\r\nDESCRIPTION:Workshopwochenende 'Argumente gegen das Zeitgeschehen %s'.\\n\\nAnreise ab %s gegen %s Uhr möglich.\\nFür Unterkunft und Verpflegung ist gesorgt\; Bettzeug muss mitgebracht werden.\\n\\n(Aktuelle) Infos:\\nwww.zeitgeschehen.net\\n\\nFür weitere Fragen:\\nzeitgeschehen@riseup.net\r\nLOCATION:Müllerweg 8 Barsinghausen OT Großgoltern 30890 Niedersachsen\r\nTRANSP:OPAQUE\r\nX-MICROSOFT-CDO-BUSYSTATUS:OOF\r\nEND:VEVENT\r\n";
  $workshop_string = "BEGIN:VEVENT\r\nDTSTAMP:%s\r\nDTSTART;TZID='Europe/Berlin':%s\r\nDTEND;TZID='Europe/Berlin':%s\r\nSUMMARY:%s\r\nURL:%s\r\nDESCRIPTION:%s\r\nLOCATION:Müllerweg 8 Barsinghausen OT Großgoltern 30890 Niedersachsen\r\nTRANSP:OPAQUE\r\nX-MICROSOFT-CDO-BUSYSTATUS:OOF\r\nBEGIN:VALARM\r\nACTION:DISPLAY\r\nDESCRIPTION:%s\r\nTRIGGER:-PT30M\r\nEND:VALARM\r\nEND:VEVENT\r\n";

  $now = time();
  $workshop_url = "http://localhost/zeitgeschehen/?p=%s";

  $ics = "";

  $ics = $ics . sprintf($intro_string, date('y', strtotime($hauszeiten["haus_oeffnungsdatum"])));

  $ics = $ics . $timezone_string;

  $ics = $ics . sprintf($whole_event_string,
    date("Ymd\THis", $now),
    date("Ymd", strtotime($hauszeiten["haus_oeffnungsdatum"])),
    date("Ymd", strtotime($hauszeiten["haus_schliessdatum"])),
    date("y", strtotime($hauszeiten["haus_oeffnungsdatum"])),
    date("y", strtotime($hauszeiten["haus_oeffnungsdatum"])),
    $wochentage[date('N', strtotime($hauszeiten["haus_oeffnungsdatum"])) - 1],
    date("H", strtotime($hauszeiten["haus_oeffnungsdatum"]))
  );

  //erste schiene
  foreach ($workshops_erste_schiene as &$workshop) {
    //erster slot
    $ics = $ics . sprintf($workshop_string,
      date("Ymd\THis", $now),
      date("Ymd\THis", strtotime($workshopzeiten["erste_schiene_anfang"])),
      date("Ymd\THis", strtotime($workshopzeiten["erste_schiene_erstes_zwischenende"])),
      $workshop[0],
      sprintf($workshop_url, $workshop[1]),
      "(1/3)",
      $workshop[0]
    );
    //zwoiter slot
    $ics = $ics . sprintf($workshop_string,
      date("Ymd\THis", $now),
      date("Ymd\THis", strtotime($workshopzeiten["erste_schiene_erster_zwischenanfang"])),
      date("Ymd\THis", strtotime($workshopzeiten["erste_schiene_zweites_zwischenende"])),
      $workshop[0],
      sprintf($workshop_url, $workshop[1]),
      "(2/3)",
      $workshop[0]
    );
    //dritter slot
    $ics = $ics . sprintf($workshop_string,
      date("Ymd\THis", $now),
      date("Ymd\THis", strtotime($workshopzeiten["erste_schiene_zweiter_zwischenanfang"])),
      date("Ymd\THis", strtotime($workshopzeiten["erste_schiene_ende"])),
      $workshop[0],
      sprintf($workshop_url, $workshop[1]),
      "(3/3)",
      $workshop[0]
    );
  };

  //zweite schiene
  foreach ($workshops_zweite_schiene as &$workshop) {
    //erster slot
    $ics = $ics . sprintf($workshop_string,
      date("Ymd\THis", $now),
      date("Ymd\THis", strtotime($workshopzeiten["zweite_schiene_anfang"])),
      date("Ymd\THis", strtotime($workshopzeiten["zweite_schiene_erstes_zwischenende"])),
      $workshop[0],
      sprintf($workshop_url, $workshop[1]),
      "(1/3)",
      $workshop[0]
    );
    //zwoiter slot
    $ics = $ics . sprintf($workshop_string,
      date("Ymd\THis", $now),
      date("Ymd\THis", strtotime($workshopzeiten["zweite_schiene_erster_zwischenanfang"])),
      date("Ymd\THis", strtotime($workshopzeiten["zweite_schiene_zweites_zwischenende"])),
      $workshop[0],
      sprintf($workshop_url, $workshop[1]),
      "(2/3)",
      $workshop[0]
    );
    //dritter slot
    $ics = $ics . sprintf($workshop_string,
      date("Ymd\THis", $now),
      date("Ymd\THis", strtotime($workshopzeiten["zweite_schiene_zweiter_zwischenanfang"])),
      date("Ymd\THis", strtotime($workshopzeiten["zweite_schiene_ende"])),
      $workshop[0],
      sprintf($workshop_url, $workshop[1]),
      "(3/3)",
      $workshop[0]
    );
  };

  $ics = $ics . "END:VCALENDAR";

  header('Content-Disposition: attachment; filename="calendar.ics"');
  header('Content-Type: text/plain');
  header('Content-Length: ' . strlen($ics));
  header('Connection: close');
  echo $ics;
 ?>
