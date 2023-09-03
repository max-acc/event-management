<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
require_once "../config/config.php";
?>


<!DOCTYPE html>
<html lang="de" dir="ltr">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta charset ="utf-8">
    <title>Home</title>
    <style>
      <?php require_once("../css/style.css"); ?>
    </style>
  </head>
  <body>
    <header>
      <?php require_once "../base/header.php"; ?>
    </header>

    <section>
      Current events
      <a href="event.php"><button type="button" name="button"></button></a>

    </section>

    <footer>

    </footer>
  </body>
</html>
