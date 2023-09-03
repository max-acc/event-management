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
      <h1>Aktuelle Veranstaltungen</h1>
      <a href="../log/logout.php">
        Logout
      </a>
    </header>

    <div class="home">
      <ul>
        <li>
          <div class="">
            <a href="event.php">Event</a>
          </div>
        </li>
        <li><a href="event.php">Event</a></li>
      </ul>
    </div>

    <footer>

    </footer>
  </body>
</html>
