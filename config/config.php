<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

//Definitionen von Server-Variablen
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'event-management');

// Versuch mit Datenbank zu verbinden
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Überprüfung der Verbindung
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
    echo "could not connect";
}
?>
