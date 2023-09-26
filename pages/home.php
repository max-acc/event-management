<?php
  // Starting the session
  session_start();

  // Check if the user is logged in, if not then redirect him to login page
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../index.php");
    exit;
  }

  // Including config file
  require_once "../config/config.php";

  // Store main database
  $eventDB = "`events`";
?>


<!DOCTYPE html>
<html lang="de" dir="ltr">
  <!--- Head ------------------------------------------------------------------>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta charset ="utf-8">
    <title>Home</title>
    <style>
      <?php require_once("../css/style.css"); ?>
    </style>
  </head>

  <body>
    <!--- Main Page ----------------------------------------------------------->
    <header>
      <h1>Aktuelle Veranstaltungen</h1>
      <a href="../log/logout.php">
        Logout
      </a>
      <a href="../log/password.php">
        Passwort ändern
      </a>
    </header>

    <div class="home">
      <ul>
        <!--- First event ----------------------------------------------------->
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

        <!--- Second Event ---------------------------------------------------->
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

        <!--- Third event ----------------------------------------------------->
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

        <!--- Add event ------------------------------------------------------->
        <li>
          <div class="add_event">
            <p>+</p>
          </div>
        </li>
      </ul>
    </div>
  </body>
</html>
