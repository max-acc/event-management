<?php
  // Initialize the session
  session_start();

  // Check if the user is logged in, if not then redirect him to login page
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header("location: ../index.php");
      exit;
  }
  require_once "../config/config.php";

  $eventName = "`test-event-1`";

  $sqlEvent = "SELECT * FROM " . $eventName;

  $eventResult = mysqli_query($link, $sqlEvent);

  $tableRows  = 0;
  $tableCols  = 5;



  if (isset($_POST['submit'])) {
    for ($i=0; $i < 3; $i++) {
      $memberName = 'member1_' . $i;
      if (!empty($_POST[$memberName])) {
        $selected = $_POST[$memberName];
        echo $selected;
        // code...
      }
    }
    /*
    if (!empty($_POST['member1_0'])) {
      $selected = $_POST['member1_0'];
      echo $selected;
      // code...
    }
    else {
      echo "select please";
    }
    if (!empty($_POST['member1_1'])) {
      $selected = $_POST['member1_1'];
      echo $selected;
      // code...
    }
    else {
      echo "select please";
    }
    if (!empty($_POST['member1_2'])) {
      $selected = $_POST['member1_2'];
      echo $selected;
    }
    else {
      echo "select please";
    }*/
  }

  /*

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //$param_member01 = trim($_POST["member01_1"]);
    //echo $param_member01;

    $member = filter_input(INPUT_POST, 'member01_1', FILTER_SANITIZE_STRING);
    //$member = isset($_POST{"member01_1"});

    echo "string";
    echo $member;
    echo "hello";


    for ($i=0; $i < $tableRows; $i++) {

      $sql = "UPDATE " . $eventName . " SET member1 = `` WHERE indexCounter = `" . $i;
    }

  }*/

?>


<!DOCTYPE html>
<html lang="de" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Event</title>
  </head>
  <body>
    <header>

    </header>

    <section>
      <?php
        echo $eventName;
      ?>
      <p>Current events</p>
      <form class="eventForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <table>
          <?php
          if ($result = $link->query($sqlEvent)) {
            /* fetch associative array */
            while ($row = $result->fetch_assoc()) {
              $tableRows  += 1;
              $indexCount   = $row["indexCounter"];
              $description  = $row["description"];
              $memberCount  = $row["numberOfMembers"];
              $member_01    = $row["member1"];
              $member_02    = $row["member2"];
              $member_03    = $row["member3"];
              $member_04    = $row["member4"];
              $member_05    = $row["member5"];
              ?>
              <tr class="<?php echo $indexCount;?>">
                <td>
                  <?php echo $description;?>
                </td>
                <td>
                  <?php if ($memberCount < 1) {goto endOfTable;} ?>
                  <select class="member1" name="member1_<?php echo $indexCount;?>" id="eventSubmit">
                    <option value="database"><?php echo $member_01;?></option>
                    <option value="changeEntry"><?php echo $_SESSION["username"];?></option>
                  </select>
                </td>
                <td>
                  <?php if ($memberCount < 2) {goto endOfTable;} ?>
                  <select class="member2" name="member2_<?php echo $indexCount;?>" id="eventSubmit">
                    <option value="database"><?php echo $member_02;?></option>
                    <option value="changeEntry"><?php echo $_SESSION["username"];?></option>
                  </select>
                </td>
                <td>
                  <?php if ($memberCount < 3) {goto endOfTable;} ?>
                  <select class="member3" name="member3_<?php echo $indexCount;?>" id="eventSubmit">
                    <option value="database"><?php echo $member_03;?></option>
                    <option value="changeEntry"><?php echo $_SESSION["username"];?></option>
                  </select>
                </td>
                <td>
                  <?php if ($memberCount < 4) {goto endOfTable;} ?>
                  <select class="member4" name="member4_<?php echo $indexCount;?>" id="eventSubmit">
                    <option value="database"><?php echo $member_04;?></option>
                    <option value="changeEntry"><?php echo $_SESSION["username"];?></option>
                  </select>
                </td>
                <td>
                  <?php if ($memberCount < 5) {goto endOfTable;} ?>
                  <select class="member5" name="member5_<?php echo $indexCount;?>" id="eventSubmit">
                    <option value="database"><?php echo $member_05;?></option>
                    <option value="changeEntry"><?php echo $_SESSION["username"];?></option>
                  </select>
                </td>
                <?php endOfTable: ?>
                <td>
                  Progressbar
                </td>
              </tr>
              <?php
            }

            /* free result set */
            $result->free();
          }
          ?>
        </table>
        <input type="submit" value="Abschicken" name="submit">
      </form>
      <?php echo $tableRows; ?>
    </section>

    <footer>

    </footer>
  </body>
</html>
