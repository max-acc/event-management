

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
