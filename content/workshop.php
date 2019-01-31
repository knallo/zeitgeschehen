<?php
	include("mysql/workshop.php");

	if (!empty($_POST['titel'])) {
    $titel = $_POST['titel'];
  }

  if (!in_array($titel, $kuerzel)) {
    include('content/404.php');
  } else {
    $workshop = get_workshop($titel, $conn);
    echo "<h3>" . $workshop["titel"] . "</h3>";
    if ($workshop["untertitel"] != "") {
      echo "<h4>" . $workshop["untertitel"] . "</h4>";
    }
    echo $workshop["einfuehrungstext"];
    echo "<div class='workshopzeiten'>";
    echo "<p class='wszeitueberschrift'>";
    echo "Der Workshop erstreckt sich über drei Teile:<br /></p><em>";
    if ($workshop["ist_erste_schiene"] == true) {
      echo $zeittext_erste_schiene;
    } else {
      echo $zeittext_zweite_schiene;
    }
    echo "</em></div>";
  }
?>

<?php
	include("mysql/close.php");
?>
