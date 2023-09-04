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
            <img src="../img/stock_img.png" alt="">
            <h2>Eventname</h2>
            <div class="description">
              <p>Beschreibung</p>
            </div>
            <a href="event.php">Zum Event</a>
          </div>
        </li>
        <li>
          <div class="">
            <img src="../img/stock_img.png" alt="">
            <h2>Eventname</h2>
            <div class="description">
              <p>Beschreibung</p>
            </div>
            <a href="event.php">Zum Event</a>
          </div>
        </li>
        <li>
          <div class="add_event">
            <p>+</p>
          </div>
        </li>
      </ul>
    </div>

    <footer>

    </footer>
  </body>
</html>
