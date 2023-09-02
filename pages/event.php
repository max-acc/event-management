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
      <table>
        <?php
        if ($result = $link->query($sqlEvent)) {
          /* fetch associative array */
          while ($row = $result->fetch_assoc()) {
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
                <select class="member1" name="" form="eventSubmit">
                  <option value="database"><?php echo $member_01;?></option>
                  <option value="changeEntry"><?php echo $_SESSION["username"];?></option>
                </select>
              </td>
              <td>
                <?php if ($memberCount < 2) {goto endOfTable;} ?>
                <select class="member2" name="" form="eventSubmit">
                  <option value="database"><?php echo $member_02;?></option>
                  <option value="changeEntry"><?php echo $_SESSION["username"];?></option>
                </select>
              </td>
              <td>
                <?php if ($memberCount < 3) {goto endOfTable;} ?>
                <select class="member3" name="" form="eventSubmit">
                  <option value="database"><?php echo $member_03;?></option>
                  <option value="changeEntry"><?php echo $_SESSION["username"];?></option>
                </select>
              </td>
              <td>
                <?php if ($memberCount < 4) {goto endOfTable;} ?>
                <select class="member4" name="" form="eventSubmit">
                  <option value="database"><?php echo $member_04;?></option>
                  <option value="changeEntry"><?php echo $_SESSION["username"];?></option>
                </select>
              </td>
              <td>
                <?php if ($memberCount < 5) {goto endOfTable;} ?>
                <select class="member5" name="" form="eventSubmit">
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

      <form class="" action="#" method="post" id="eventSubmit">
        <input type="submit" value="Send">
      </form>
    </section>

    <footer>

    </footer>
  </body>
</html>
