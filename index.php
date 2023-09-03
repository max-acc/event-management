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
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
      <meta charset="utf-8">
      <title>Plan</title>
      <link rel="stylesheet"  href="css/style.css"  type="text/css">
    </head>

    <body style="">
      <div>
        <!--Header--------------------------------------------------------------------->
        <header>
          <p>hello</p>
        </header>


        <!--Section Space-------------------------------------------------------------->
        <section class="space">
          <p>hello</p>
          <a href="log/login.php"><button type="button" name="button">Login</button></a>
        </section>


        <!--Footer--------------------------------------------------------------------->
        <footer>
          <?php require_once "base/footer.php"; ?>
        </footer>
      </div>
    </body>
    <?php //require_once "script/script.html"; ?>
 </html>
