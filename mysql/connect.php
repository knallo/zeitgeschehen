<?php     
$servername = "fruehlingsseminar.lima-db.de";
$username = "USER291951";
$password = "jYfmVtIdy";
$dbname = "db_291951_2";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Leider ist bei der Verbindung mit der Datenbank etwas schief gelaufen. Bitte benachrichtige den Administrator und schreib ihm folgende Fehlernachricht: " . mysqli_connect_error());
}

?>
