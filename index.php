<?php
// Start der Session
session_start();
// Einbindung von config.php
require_once "config/config.php";
?>

 <!DOCTYPE html>

 <html lang="de" dir="ltr">
  <!--- Head ------------------------------------------------------------------->
    <head>
      <meta charset="utf-8">
      <title>Plan</title>
      <link rel="stylesheet"  href="css/style.css"  type="text/css">
    </head>

    <body>
      <div id="wrapper">
        <!--Header--------------------------------------------------------------------->
        <header>
          <?php require_once "base/header.php"; ?>
        </header>


        <!--Section Space-------------------------------------------------------------->
        <section class="space">
        </section>


        <!--Footer--------------------------------------------------------------------->
        <footer>
          <?php require_once "base/footer.php"; ?>
        </footer>
      </div>
    </body>
    <?php //require_once "script/script.html"; ?>
 </html>
