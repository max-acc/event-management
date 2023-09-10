<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../index.php");
    exit;
}
require_once "../config/config.php";

// Definition von Variablen und initialisierung mit leeren Werten
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// Verarbeitung von Formulardaten beim Absenden des Formulars
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Bestätigung des Passworts
    if(empty(trim($_POST["password"]))){
        $password_err = "<p>Bitte geben Sie ein Passwort ein.</p>";
    } elseif(strlen(trim($_POST["password"])) < 5){
        $password_err = "<p>Bitte geben Sie mindestens 5 Zeichen ein.</p>";
    } else{
        $password = trim($_POST["password"]);
    }

    // Bestätigung des bestätigten Passworts
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "<p>Bitte wiederholen Sie ihr Passwort.</p>";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "<p>Passwörter stimmen nicht überein.</p>";
        }
    }

    // Überprüfung auf Eingabefehler bevor Daten zur Datenbank geschickt werden
    if(empty($password_err) && empty($confirm_password_err)){

        // Vorbereitung eines Eingabe-Statements
        $sql = "UPDATE user SET password = '$password' WHERE username = " . $_SESSION["username"];
        $param_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE user SET password = '$param_password' WHERE id = " . $_SESSION["id"];;

        if($stmt = mysqli_prepare($link, $sql)){
            // Variablen als vorberitete Statements an Parameter binden
            //mysqli_stmt_bind_param($stmt, "ss", $param_password);

            // Parameter setzen
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Generierung des Passwort Hashes

            // Versuch das vorbereitete Statement auszuführen
            if(mysqli_stmt_execute($stmt)){
                // Weiterleitung zu login.php
                //header("location: login.php");
            } else{
                echo "hi " . $username;
                echo "<p>Etwas ist schief gelaufen. Probieren Sie es später nochmal.</p>";
            }


            // Schließung des Statements
            mysqli_stmt_close($stmt);
        }
    }


}
?>

<!DOCTYPE html>

<html lang="de">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta charset ="utf-8">
    <title>Registrieren</title>
    <style>
      <?php require_once("../css/style_log.css"); ?>
    </style>
  </head>


  <body>
    <div class="log">
      <form class="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h1>Passwort ändern</h1>

        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
          <input type="password"  maxlength="250" name="password" placeholder="Passwort eingeben" value="<?php echo $password; ?>"><br>
          <span class="help-block"><?php echo $password_err; ?></span>
        </div>

        <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
          <input type="password"  maxlength="250" name="confirm_password" placeholder="Passwort wiederholen" value="<?php echo $confirm_password; ?>"><br><br>
          <span class="help-block"><?php echo $confirm_password_err; ?></span>
        </div>
        <div>
          <input type="submit" value="Registrieren">
        </div>
      </form>
    </div>
  </body>
</html>
