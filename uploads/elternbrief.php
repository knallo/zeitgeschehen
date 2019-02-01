<?php
  include('../mysql/connect.php');

  $elternbrief_format = "# Elternbrief: Argumente gegen das Zeitgeschehen\n\nÜber Pfingsten (%s bis %s) %s haben wir als Arbeitskreis Auflösen das \"Argumente gegen das Zeitgeschehen\" organisiert, an dem verschiedene politische Workshops angeboten werden. Während der Zeit werden wir uns in und um das \"Seminarhaus und Erlebnishof ekom\" in Großgoltern (bei Hannover) aufhalten. Dort gibt es Übernachtungsmöglichkeiten und dort werden auch die Workshops stattfinden.\n\nDen Tag über wird es ein Workshopprogramm geben, für das wir verschiedene Referenten eingeladen haben. Zwischendurch bietet das Haus viel Grünfläche, eine Tischtennisplatte, abends eine Lagerfauerstelle uvm.. Außerdem ist in Fußnähe ein Dorf mit allem Nötigen und ein Freibad.\n\nDie Adresse des Hauses ist:\n\n_Müllerweg 8_\n\n_30890 Barsinghausen_\n\n_Niedersachsen_\n\nIn Notfällen sind Leute mit Überblick unter folgender Handynummer erreichbar: 0172 2010396\n\nFür die Finanzierung der Fahrt (Übernachtungen und Verpflegung) würden wir uns freuen, wenn jeder Teilnehmer insgesamt %s-%s€ zahlen kann. Für alle, die sich nur einen geringeren oder gar keinen Beitrag leisten können, werden die Kosten übernommen. Am Geld soll eine Teilnahme nicht scheitern!\n\nEs werden zwar auch einige Volljährige dabei sein, dennoch sind Minderjährige während der Zeit für sich selbst verantwortlich und können nur mitkommen, wenn ihre Eltern dem ausdrücklich zustimmen. Denn die Fahrt ist selbstorganisiert - keiner von uns will, bloß weil er zufällig schon über 18 ist, haftbar gemacht werden für die Aktionen anderer Teilnehmer.\n\nDarum sollen alle Jugendliche unter 18 den folgenden Vordruck - von den Eltern ausgefüllt und unterschrieben - mitbringen:\n\n========================================================\n\nIch bin damit einverstanden dass mein Sohn / meine Tochter:\n\nO in der Zeit von Freitag, den 18.05. bis Dienstag, den 22.05. 2018\n\nO in der Zeit von &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; bis\n\n*auf eigene Verantwortung* mit in das Seminarhaus ekom fährt.\n\nAuch Volljährige vor Ort übernehmen keine Haftung.\n<br /><br /><br /><br /><br /><br />\nDatum und Unterschrift eines Erziehungsberechtigten";

  $daten = $conn->query("SELECT anfangsdatum, enddatum, kosten_untere_schranke, kosten_obere_schranke FROM allgemein")->fetch_assoc();
  $elternbrief = sprintf($elternbrief_format,
    date("d.m.", strtotime($daten["anfangsdatum"])),
    date("d.m.", strtotime($daten["enddatum"])),
    date("Y", strtotime($daten["anfangsdatum"])),
    $daten["kosten_untere_schranke"],
    $daten["kosten_obere_schranke"]
  );

  header('Content-Disposition: attachment; filename="elternbrief.md"');
  header('Content-Type: text/plain');
  header('Content-Length: ' . strlen($elternbrief));
  header('Connection: close');

  echo $elternbrief;
?>
