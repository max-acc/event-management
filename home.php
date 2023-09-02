<?php
// Initialize the session
session_start();
$Klasse = $Stunde = $Fach = $Vertreter = $verlegtVon = $stattLehrer = $stattFach = $Bemerkung = $Raum = "-";


// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
require_once "../config/config.php";
?>
