<?php
  // Starting the session
  session_start();
  // Including config file
  require_once "config/config.php";
?>

 <!DOCTYPE html>

 <html lang="de" dir="ltr">
  <!--- Head ------------------------------------------------------------------>
    <head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
      <meta charset ="utf-8">
      <title>Main Page</title>
      <style>
        <?php require_once("css/style.css"); ?>
      </style>
    </head>

    <body class="index">
      <!--- Main Page --------------------------------------------------------->
      <div>
        <h1>Event Management Tool</h1>
        <img src="img/logo.png" alt="" style="">

        <!--- Section Space --------------------------------------------------->
        <section class="space">
          <a href="log/login.php">Login</a>
        </section>

        <!--- Footer ---------------------------------------------------------->
        <footer>
        </footer>
      </div>
    </body>
    <?php //require_once "script/script.html"; ?>
 </html>
