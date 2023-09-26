<?php
  /* Database credentials. Assuming you are running MySQL
  server with default setting (user 'root' with no password) */

  // Definition of Server variables / credentials
  define('DB_SERVER', 'localhost');
  define('DB_USERNAME', 'root');
  define('DB_PASSWORD', '');
  define('DB_NAME', 'event-management');

  // Trying to connect with the database
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

  // Checking the connection
  if($link === false){
    die("ERROR M-400: An error occured while establishing a connectionCould not connect. " . mysqli_connect_error());
    echo "ERROR M-400: Could not connect!";
  }
?>
