<?php

  include("mysql/connect.php");

  $kosten = $conn->query("SELECT kosten_obere_schranke, kosten_untere_schranke FROM allgemein")->fetch_assoc();
  $oben = $kosten["kosten_obere_schranke"];
  $unten = $kosten["kosten_untere_schranke"];
?>
