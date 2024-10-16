<?php
  // Initialize the session
  session_start();

  // Check if the user is logged in, if not then redirect him to login page
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header("location: ../index.php");
      exit;
  }
  require_once "../config/config.php";

  $eventDB = "`events`";
  $eventDBname = "`event_2`";

  $sqlEvent = "SELECT * FROM " . $eventDBname;

  $eventResult = mysqli_query($link, $sqlEvent);

  $tableRows  = 0;
  $tableCols  = 5;

  $sql_row = "SELECT * FROM " . $eventDBname;
  if ($result = mysqli_query($link, $sql_row)) {

    // Return the number of rows in result set
    $tableRows = mysqli_num_rows($result);

    // Display result
    //printf("Total rows in this table :  %d\n", $tableRows);
  }

  $memberContent = array();
  $sql = "";

  //if (isset($_POST['submit'])) {
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    for ($i=0; $i < $tableRows; $i++) {
      $setVar = "";
      $changeDetection = false;
      $username = $_SESSION["username"];

      $memberName = 'member1_' . $i;
      if (!empty($_POST[$memberName])) {
        $selected = $_POST[$memberName];
        $memberContent[] = $selected;
        if ($selected == "changeEntry") {
          $changeDetection = true;
          $setVar .= "SET member1 = '$username'";
        }
      }
      $memberName = 'member2_' . $i;
      if (!empty($_POST[$memberName])) {
        $selected = $_POST[$memberName];
        $memberContent[] = $selected;
        if ($selected == "changeEntry") {
          $changeDetection = true;
          if (empty($setVar)) {
            $setVar .= "SET member2 = '$username'";
          }else {
            $setVar .= ", member2 = '$username'";
          }
        }
      }
      $memberName = 'member3_' . $i;
      if (!empty($_POST[$memberName])) {
        $selected = $_POST[$memberName];
        $memberContent[] = $selected;
        if ($selected == "changeEntry") {
          $changeDetection = true;
          if (empty($setVar)) {
            $setVar .= "SET member3 = '$username'";
          }else {
            $setVar .= ", member3 = '$username'";
          }
        }
      }
      $memberName = 'member4_' . $i;
      if (!empty($_POST[$memberName])) {
        $selected = $_POST[$memberName];
        $memberContent[] = $selected;
        if ($selected == "changeEntry") {
          $changeDetection = true;
          if (empty($setVar)) {
            $setVar .= "SET member4 = '$username'";
          }else {
            $setVar .= ", member4 = '$username'";
          }
        }
      }
      $memberName = 'member5_' . $i;
      if (!empty($_POST[$memberName])) {
        $selected = $_POST[$memberName];
        $memberContent[] = $selected;
        if ($selected == "changeEntry") {
          $changeDetection = true;
          if (empty($setVar)) {
            $setVar .= "SET member5 = '$username'";
          }else {
            $setVar .= ", member5 = '$username'";
          }
        }
      }
      //$setVar     = " SET member1 = `$memberContent[0]`, member2 = `$memberContent[1]`, member3 = `$memberContent[2]`, member4 = `$memberContent[3]`, member5 = `$memberContent[4]`";
      if ($changeDetection) {
        $condition  = " WHERE indexCounter = " . $i;
        $sql        .= "UPDATE " . $eventDBname . " " . $setVar . $condition . " ";
      }

    }
    if($stmt = mysqli_prepare($link, $sql)){

        // Versuch das vorbereitete Statement auszuführen
        if(mysqli_stmt_execute($stmt)){
            // Weiterleitung zu login.php
            header("location: #");
        } else{
            echo "hi " . $username;
            echo "<p>Etwas ist schief gelaufen. Probieren Sie es später nochmal.</p>";
        }

        // Schließung des Statements
        mysqli_stmt_close($stmt);
    }
  }

?>


<!DOCTYPE html>
<html lang="de" dir="ltr">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta charset ="utf-8">
    <title>Event</title>
    <style>
      <?php require_once("../css/style.css"); ?>
    </style>
  </head>
  <body>
    <header>
      <h1>Aktuelle Veranstaltungen</h1>
      <a href="home.php">
        Zurück
      </a>
    </header>

    <div class="event" style="color: white;">
      <h1>
        <?php
        if ($result = $link->query("SELECT * FROM " . $eventDB . "WHERE event_index = 2")) {
          $row = $result->fetch_assoc();
          echo $row["event_name"];
        } ?>
      </h1>

      <form class="eventForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <table>
          <?php
          if (($result = $link->query($sqlEvent)) && ($result_1 = $link->query("SELECT * FROM " . $eventDB . "WHERE event_index = 2"))) {
            $event_overwrite = false;
            $temp_row = $result_1->fetch_assoc();
            if ($temp_row["event_overwrite"] == 1) {
              $event_overwrite = true;
            }else {
              $event_overwrite = false;
            }
            /* fetch associative array */
            while ($row = $result->fetch_assoc()) {
              $tableRows  += 1;
              $indexCount   = $row["indexCounter"];
              $category     = $row["category"];
              $memberCount  = $row["numberOfMembers"];
              $member_01    = $row["member1"];
              $member_02    = $row["member2"];
              $member_03    = $row["member3"];
              $member_04    = $row["member4"];
              $member_05    = $row["member5"];
              ?>
              <tr class="<?php echo $indexCount;?>">
                <td class="event_cat">
                  <?php echo $category;?>
                </td>
                <?php col1: ?>
                <td>
                  <?php if ($memberCount < 1) {goto col2;} ?>
                  <select class="member1" name="member1_<?php echo $indexCount;?>" id="eventSubmit">
                    <option value="database"><?php echo $member_01;?></option>
                    <?php
                    if (($event_overwrite == true) || (strlen($member_01) == 0)) { ?>
                        <option value="changeEntry"><?php echo $_SESSION["username"];?></option>
                      <?php
                    }
                     ?>
                  </select>
                  <?php col2: ?>
                </td>
                <td>
                  <?php if ($memberCount < 2) {goto col3;} ?>
                  <select class="member2" name="member2_<?php echo $indexCount;?>" id="eventSubmit">
                    <option value="database"><?php echo $member_02;?></option>
                    <?php
                    if (($event_overwrite == true) || (strlen($member_02) == 0)) { ?>
                        <option value="changeEntry"><?php echo $_SESSION["username"];?></option>
                      <?php
                    }
                     ?>
                  </select>
                  <?php col3: ?>
                </td>
                <td>
                  <?php if ($memberCount < 3) {goto col4;} ?>
                  <select class="member3" name="member3_<?php echo $indexCount;?>" id="eventSubmit">
                    <option value="database"><?php echo $member_03;?></option>
                    <?php
                    if (($event_overwrite == true) || (strlen($member_03) == 0)) { ?>
                        <option value="changeEntry"><?php echo $_SESSION["username"];?></option>
                      <?php
                    }
                     ?>
                  </select>
                  <?php col4: ?>
                </td>
                <td>
                  <?php if ($memberCount < 4) {goto col5;} ?>
                  <select class="member4" name="member4_<?php echo $indexCount;?>" id="eventSubmit">
                    <option value="database"><?php echo $member_04;?></option>
                    <?php
                    if (($event_overwrite == true) || (strlen($member_04) == 0)) { ?>
                        <option value="changeEntry"><?php echo $_SESSION["username"];?></option>
                      <?php
                    }
                     ?>
                  </select>
                  <?php col5: ?>
                </td>
                <td>
                  <?php if ($memberCount < 5) {goto endOfTable;} ?>
                  <select class="member5" name="member5_<?php echo $indexCount;?>" id="eventSubmit">
                    <option value="database"><?php echo $member_05;?></option>
                    <?php
                    if (($event_overwrite == true) || (strlen($member_05) == 0)) { ?>
                        <option value="changeEntry"><?php echo $_SESSION["username"];?></option>
                      <?php
                    }
                     ?>
                  </select>
                <?php endOfTable: ?>
                </td>
                <td>
                  <!--Progressbar-->
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
    </div>

    <footer>

    </footer>
  </body>
</html>
