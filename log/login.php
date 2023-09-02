<?php
// Initialisierung der Session
session_start();

// Überprüfung ob der User schon eingeloggt ist, wenn ja wird er direkt weitergeleitet
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../logout.php");
    exit;
}

// Einbindung von config.php
require_once "../config/config.php";

// Definition von Variablen und initialisierung mit leeren Werten
$username = $password = "";
$username_err = $password_err = "";

// Verarbeitung von Vormulardaten beim absenden des Formulars
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Überprüfung ob der Username leer ist
    if(empty(trim($_POST["username"]))){
        $username_err = "Bitte geben Sie ihren Usernamen ein";
    } else{
        $username = trim($_POST["username"]);
    }

    // Überprüfung ob das Passwort leer ist
    if(empty(trim($_POST["password"]))){
        $password_err = "Bitte geben Sie ihr Passwort ein.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Anmeldeinformationen überprüfen
    if(empty($username_err) && empty($password_err)){
        // Vorbereitung eines Auswahl-Statements
        $sql = "SELECT id, username, password FROM users WHERE username = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Variablen als vorberitete Statements an Parameter binden
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Parameter setzen
            $param_username = $username;

            // Versuch vorbereitetes Statement auszuführen
            if(mysqli_stmt_execute($stmt)){
                // Speichern der Ergebnisse
                mysqli_stmt_store_result($stmt);

                // Überprüfung ob Passwort existiert, wenn ja wird das Passwort verifiziert
                if(mysqli_stmt_num_rows($stmt) == 1){
                    // Bindung der Ergebnisse an Variablen
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Wenn das Passwort richtig ist wird eine neue Session gestartet
                            session_start();

                            // Speicherung der Daten in Session VariablenStore data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            // Weiterleitung
                            header("location: ../config/home.php");
                        } else{
                            // Anzeigen einer Fehlermeldung, wenn das Passwort nicht richtig ist
                            $password_err = "Das Passwort war nicht richtig.";
                        }
                    }
                } else{
                    // Anzeigen einer Fehlermeldung, wenn es den Unsername nicht gibt
                    $username_err = "Kein Account mit diesem Usernamen gefunden";
                }
            } else{
                echo "Ups! Etwas ist falsch gelaufen. Versuchen Sie es später nochmal oder wenden Sie sich an den Support.";
            }

            // Schließung des Statements
            mysqli_stmt_close($stmt);
        }
    }

    // Schließung der Verbindung
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="de" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet"  href="../css/log.css"  type="text/css">
    <link rel="stylesheet"  href="../css/style.css"  type="text/css">
    <meta charset ="utf-8">
  </head>
  <body>
    <form class="log" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <h1>Login</h1>
      <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
        <input type="text" name="username" placeholder="Benutzername" value="<?php echo $username; ?>">
        <span class="help-block"><?php echo $username_err; ?></span>
      </div>
      <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
        <input type="password" name="password" placeholder="Passwort">
        <span class="help-block"><?php echo $password_err; ?></span>
      </div>
      <input type="submit" name="" value="Login">
      <a href="../index.php">Zurück</a>
    </form>
  </body>
</html>
