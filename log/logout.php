<?php
// Start der Session
session_start();

// Deaktivierung von Sitzungsvariablen
$_SESSION = array();

// Zerstören der Session
session_destroy();

// Weiterleiten zu index.php
header("location: ../index.php");
exit;
?>
