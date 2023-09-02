<?php
// Einbindung von config.php
require_once "../config/config.php";

// Definition von Variablen und initialisierung mit leeren Werten
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// Verarbeitung von Formulardaten beim Absenden des Formulars
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Überprüfung des Nutzernamens
    if(empty(trim($_POST["username"]))){
        $username_err = "<p>Bitte geben Sie einen Usernamen ein.</p>";
    } else{
        // Vorbereitung für Auswahl von Datenbank
        $sql = "SELECT id FROM user WHERE username = ?";
        echo "hi3 " . $username;
        if($stmt = mysqli_prepare($link, $sql)){
            echo "hi3 " . $username;
            // Vorbereitete Statements an Parameter binden
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Setzen von Parametern
            $param_username = trim($_POST["username"]);

            // Versuch die vorberiteten Statements auszuführen
            if(mysqli_stmt_execute($stmt)){
                /* speicherung des Statements */
                mysqli_stmt_store_result($stmt);
                //  Überprüfung des usernames
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "<p>Dieser Username ist schon vergeben.</p>";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "<p>Ups! Etwas ist schief gelaufen. Probieren Sie es später erneut.</p>";
            }

            // Schließung von Statement
            mysqli_stmt_close($stmt);
        }
    }

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
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){

        // Vorbereitung eines Eingabe-Statements
        $sql = "INSERT INTO user (username, password) VALUES (?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            // Variablen als vorberitete Statements an Parameter binden
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

            // Parameter setzen
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Generierung des Passwort Hashes

            // Versuch das vorbereitete Statement auszuführen
            if(mysqli_stmt_execute($stmt)){
                // Weiterleitung zu login.php
                header("location: login.php");
            } else{
                echo "hi " . $username;
                echo "<p>Etwas ist schief gelaufen. Probieren Sie es später nochmal.</p>";
            }

            // Schließung des Statements
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>

<html lang="de">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>Registrieren</title>
    <meta charset ="utf-8">
  </head>


  <body>
    <form class="log" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <h1>Registrieren</h1>

      <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
        <input type="text"  maxlength="250" name="username" placeholder="Usernamen eingeben" value="<?php echo $username; ?>"><br><br>
        <span class="help-block"><?php echo $username_err; ?></span>
      </div>

      <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
        <input type="password"  maxlength="250" name="password" placeholder="Passwort eingeben" value="<?php echo $password; ?>"><br>
        <span class="help-block"><?php echo $password_err; ?></span>
      </div>

      <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
        <input type="password"  maxlength="250" name="confirm_password" placeholder="Passwort wiederholen" value="<?php echo $confirm_password; ?>"><br><br>
        <span class="help-block"><?php echo $confirm_password_err; ?></span>
      </div>
      <div>
        <input type="submit" value="Abschicken">
      </div>
    </form>
  </body>
</html>
