<?php
  // Starting the session
  session_start();

  // Deactivating des session variables
  $_SESSION = array();

  // Deleting the session
  session_destroy();

  // Redirecting to index.php
  header("location: ../index.php");
  exit;
?>
