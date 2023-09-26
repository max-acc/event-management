<?php
  // Including config file
  require_once "../config/config.php";

  // Definition for variables with emptyl values
  $username = $password = $confirm_password = "";
  $username_err = $password_err = $confirm_password_err = "";

  // Processing of data when form is posted
  if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if the username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "<p>Bitte geben Sie einen Usernamen ein.</p>";
    } else{
        // Prepare SQL statement for database
        $sql = "SELECT id FROM user WHERE username = ?";
        echo "hi3 " . $username;
        if($stmt = mysqli_prepare($link, $sql)){
            echo "hi3 " . $username;
            // Bind prepared statement to parameter
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set username parameters
            $param_username = trim($_POST["username"]);

            // Try to execute the prepared statemnts
            if(mysqli_stmt_execute($stmt)){
                // Storing the statements
                mysqli_stmt_store_result($stmt);
                //  Checking the statements
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "<p>Dieser Username ist schon vergeben.</p>";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "<p>Ups! Etwas ist schief gelaufen. Probieren Sie es später erneut.</p>";
            }

            // Closing the statement
            mysqli_stmt_close($stmt);
        }
    }

    // Confirming the password
    if(empty(trim($_POST["password"]))){
        $password_err = "<p>Bitte geben Sie ein Passwort ein.</p>";
    } elseif(strlen(trim($_POST["password"])) < 5){
        $password_err = "<p>Bitte geben Sie mindestens 5 Zeichen ein.</p>";
    } else{
        $password = trim($_POST["password"]);
    }

    // Confirming the confirmed password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "<p>Bitte wiederholen Sie ihr Passwort.</p>";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "<p>Passwörter stimmen nicht überein.</p>";
        }
    }

    // Check if there are input errros before the data is send to the database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){

        // Preparing the input statement
        $sql = "INSERT INTO user (username, password) VALUES (?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables as prepared statement to parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Generate password hash

            // Try to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirection ...
                header("location: login.php");
            } else{
                echo "hi " . $username;
                echo "<p>Etwas ist schief gelaufen. Probieren Sie es später nochmal.</p>";
            }

            // Closing the statement
            mysqli_stmt_close($stmt);
        }
     }
  }
?>

<!DOCTYPE html>

<html lang="de">
  <!--- Head ------------------------------------------------------------------>
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
        <h1>Registrieren</h1>
        <!--- Main Page ----------------------------------------------------------->
        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
          <input type="text"  maxlength="250" name="username" placeholder="Usernamen eingeben" value="<?php echo $username; ?>"><br><br>
          <span class="help-block"><?php echo $username_err; ?></span>
        </div>
        <!--- Password input field -------------------------------------------->
        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
          <input type="password"  maxlength="250" name="password" placeholder="Passwort eingeben" value="<?php echo $password; ?>"><br>
          <span class="help-block"><?php echo $password_err; ?></span>
        </div>
        <!--- Password input field -------------------------------------------->
        <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
          <input type="password"  maxlength="250" name="confirm_password" placeholder="Passwort wiederholen" value="<?php echo $confirm_password; ?>"><br><br>
          <span class="help-block"><?php echo $confirm_password_err; ?></span>
        </div>
        <!--- Submit and redirection button ----------------------------------->
        <div>
          <input type="submit" value="Registrieren">
        </div>
      </form>
    </div>
  </body>
</html>
