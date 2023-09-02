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
    <meta charset="utf-8">
    <title>Home</title>
  </head>
  <body>
    <header>

    </header>

    <section>
      Current events
      <a href="event.php"><button type="button" name="button"></button></a>

    </section>

    <footer>

    </footer>
  </body>
</html>
