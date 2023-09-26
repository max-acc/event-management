<?php
  // Starting the session
  session_start();

  // Checking if the user is already logged in. If true: redirection to logout
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../index.php");
    exit;
  }

  // Including config file
  require_once "../config/config.php";

  // Definition for variables with emptyl values
  $username = $password = $confirm_password = "";
  $username_err = $password_err = $confirm_password_err = "";

  // Processing of data when form is posted
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Check the password
    if(empty(trim($_POST["password"]))){
        $password_err = "<p>Bitte geben Sie ein Passwort ein.</p>";
    } elseif(strlen(trim($_POST["password"])) < 5){
        $password_err = "<p>Bitte geben Sie mindestens 5 Zeichen ein.</p>";
    } else{
        $password = trim($_POST["password"]);
    }

    // Confirming the password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "<p>Bitte wiederholen Sie ihr Passwort.</p>";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "<p>Passwörter stimmen nicht überein.</p>";
        }
    }

    // Check the input for errors before sending it to the database
    if(empty($password_err) && empty($confirm_password_err)){

        // Preparing the input statement
        $sql = "UPDATE user SET password = '$password' WHERE username = " . $_SESSION["username"];
        $param_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE user SET password = '$param_password' WHERE id = " . $_SESSION["id"];;

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind prepared varialbes as statement to parameters
            //mysqli_stmt_bind_param($stmt, "ss", $param_password);

            // Set password parameters
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Generating a password hash

            // Try to execute the prepared StatementVersuch das vorbereitete Statement auszuführen
            if(mysqli_stmt_execute($stmt)){
                // Redirection ...
                header("location: ../pages/home.php");
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
    <!--- Main Page ----------------------------------------------------------->
    <div class="log">
      <form class="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h1>Passwort ändern</h1>

        <!--- Password input field 1 ------------------------------------------>
        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
          <input type="password"  maxlength="250" name="password" placeholder="Passwort eingeben" value="<?php echo $password; ?>"><br>
          <span class="help-block"><?php echo $password_err; ?></span>
        </div>

        <!--- Password input field 2 ------------------------------------------>
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
