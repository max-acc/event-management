<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
require_once "../config/config.php";

$eventDB = "`events`";
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
        <?php
        if ($result = $link->query("SELECT * FROM " . $eventDB . "WHERE event_index = 0")) {
          $row = $result->fetch_assoc();
          if ($row["event_active"] != 1) {
            goto EndEvent0;
          }
        ?>
        <li>
          <div class="">
            <img src="../img/stock_img.png" alt="">
            <h2><?php echo $row["event_name"]; ?></h2>
            <div class="description">
              <p><?php echo $row["event_description"]; ?></p>
            </div>
            <a href="event_0.php">Zum Event</a>
          </div>
        </li>
      <?php } EndEvent0:?>
        <?php
        if ($result = $link->query("SELECT * FROM " . $eventDB . "WHERE event_index = 1")) {
          $row = $result->fetch_assoc();
          if ($row["event_active"] != 1) {
            goto EndEvent1;
          }
        ?>
        <li>
          <div class="">
            <img src="../img/stock_img.png" alt="">
            <h2><?php echo $row["event_name"]; ?></h2>
            <div class="description">
              <p><?php echo $row["event_description"]; ?></p>
            </div>
            <a href="event_1.php">Zum Event</a>
          </div>
        </li>
      <?php } EndEvent1:?>
        <?php
        if ($result = $link->query("SELECT * FROM " . $eventDB . "WHERE event_index = 2")) {
          $row = $result->fetch_assoc();
          if ($row["event_active"] != 1) {
            goto EndEvent2;
          }
        ?>
        <li>
          <div class="">
            <img src="../img/stock_img.png" alt="">
            <h2><?php echo $row["event_name"]; ?></h2>
            <div class="description">
              <p><?php echo $row["event_description"]; ?></p>
            </div>
            <a href="event_2.php">Zum Event</a>
          </div>
        </li>
        <?php } EndEvent2:?>
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
