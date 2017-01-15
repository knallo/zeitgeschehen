<?php     
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zeitgeschehen";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Leider ist bei der Verbindung mit der Datenbank etwas schief gelaufen. Bitte benachrichtige den Administrator und schreib ihm folgende Fehlernachricht:" . $conn->connect_error);
}

?>