<?php
  // Starting the session
  session_start();

  // Checking if the user is already logged in. If true: redirection to logout
  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../log/logout.php");
    exit;
  }

  // Including config file
  require_once "../config/config.php";

  // Definition for variables with emptyl values
  $username = $password = "";
  $username_err = $password_err = "";

  // Processing of data when form is posted
  if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if the username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Bitte geben Sie Ihren Nuternamen ein.";
    } else{
        $username = trim($_POST["username"]);
    }

    // Check if the password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Bitte geben Sie Ihr Passwort ein.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Check the login data
    if(empty($username_err) && empty($password_err)){
        // Prepare SQL statement
        $sql = "SELECT id, username, password FROM user WHERE username = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind prepared varialbes as statement to parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set username parameters
            $param_username = $username;

            // Trying to execute the statement
            if(mysqli_stmt_execute($stmt)){
                // Safe the result of the statement
                mysqli_stmt_store_result($stmt);

                // Check if the password exists and if true, verify it
                if(mysqli_stmt_num_rows($stmt) == 1){
                    // Bind the the result to a variable
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // If the password is correct, a new session is started
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            // Redirection ...
                            header("location: ../pages/home.php");
                        } else{
                            // Display an error message if the password was not correct
                            $password_err = "Das Passwort war nicht richtig.";
                        }
                    }
                } else{
                    // Display an error message if the username was not correct
                    $username_err = "Kein Account mit diesem Usernamen gefunden";
                }
            } else{
                // Display an error message if something else did not work out as intended
                echo "Ups! Etwas ist falsch gelaufen. Versuchen Sie es später nochmal oder wenden Sie sich an den Support.";
            }

            // Closing the statement
            mysqli_stmt_close($stmt);
        }
    }

    // Closing the connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="de" dir="ltr">
  <!--- Head ------------------------------------------------------------------>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta charset ="utf-8">
    <title>Login</title>
    <style>
      <?php require_once("../css/style_log.css"); ?>
    </style>
  </head>

  <body>
    <!--- Main Page ----------------------------------------------------------->
    <div class="log">
      <form class="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h1>Login</h1>
        <!--- Username input field -------------------------------------------->
        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
          <input type="text" name="username" placeholder="Benutzername" value="<?php echo $username; ?>">
          <span class="help-block"><?php echo $username_err; ?></span>
        </div>
        <!--- Password input field -------------------------------------------->
        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
          <input type="password" name="password" placeholder="Passwort">
          <span class="help-block"><?php echo $password_err; ?></span>
        </div>
        <!--- Submit and redirection button ----------------------------------->
        <input type="submit" name="" value="Login">
        <a href="../index.php">Zurück</a>
      </form>
    </div>

  </body>
</html>
