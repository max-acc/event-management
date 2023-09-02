<?php
// Start der Session
session_start();
// Einbindung von config.php
require_once "config/config.php";

$sqlLehrer = "SELECT * FROM lehrer";
$lehrerErgeb = mysqli_query($link, $sqlLehrer);

$sqlPlan = "SELECT * FROM plan";
$planErgeb=mysqli_query($link, $sqlPlan);

date_default_timezone_set("Europe/Berlin");
$times = time();
$datum = date("d.m.Y",$times);
$weeknumber = date('W');
if ($weeknumber % 2 == 0) {
  $week = "Woche A";
}else if ($weeknumber % 2 == 1) {
  $week = "Woche B";
}else {
  $week = "Fehler";
}

 ?>

 <!DOCTYPE html>

 <html lang="de">
 <!--- Head ------------------------------------------------------------------->
 <head>
   <title>Plan</title>
   <link rel="stylesheet"  href="css/style.css"  type="text/css">
 </head>
 <body>
 <div id="wrapper">
 <!--Header--------------------------------------------------------------------->
   <header>
     <?php require_once "base/header.php"; ?>
   </header>


 <!--Section Space-------------------------------------------------------------->
   <section class="space">
     <h1 style="z-index: 11; text-align: center; font-size: 3em;">Ein Plan</h1>
   </section>

 <!--Section Tabellen ---------------------------------------------------------->
   <section class="table">
     <div class="info">
       <table style="width: 100%; border:1px solid;">
         <tr>
           <td style="width: 150px; border-bottom: 1px solid;"></td>
           <td style="text-align: center; border-bottom: 1px solid;">Der Vertretungsplan</td>
           <td style="text-align: right; width: 150px; border-bottom: 1px solid; border-left: 1px solid;"><?php echo $datum; ?></td>
         </tr>
         <tr>
           <td style="width: 150px; ">Fehlende Lehrer:</td>
           <td style="text-align: left; border-left: 1px solid;"><?php while($row = mysqli_fetch_object($lehrerErgeb)){echo $row->Lehrer;} ?></td>
           <td style="text-align: right; width: 150px; border-left: 1px solid;"><?php echo $week; ?></td>
         </tr>
       </table>
     </div>

 <!--Vertretungsplan------------------------------------------------------------>
     <div class="plan">
       <table>
         <tr>
           <th class="one">Klasse</td>
           <th class="two">Stunde</td>
           <th class="one">Fach</td>
           <th class="two">Raum</td>
           <th class="one">Vertreter</td>
           <th class="two">verlegt von</td>
           <th class="one">statt Lehrer</td>
           <th class="two">statt Fach</td>
           <th class="one">Bemerkung</td>
         </tr>
         <?php  while($row = mysqli_fetch_object($planErgeb)){
           	echo "<tr>";
             echo "<td>";
             echo $row->Klasse;
             echo "</td>";
             echo "<td>";
             echo $row->Stunde;
             echo "</td>";
             echo "<td>";
             echo $row->Fach;
             echo "</td>";
             echo "<td>";
             echo $row->Raum;
             echo "</td>";
             echo "<td>";
             echo $row->Vertreter;
             echo "</td>";
             echo "<td>";
             echo $row->verlegtVon;
             echo "</td>";
             echo "<td>";
             echo $row->stattLehrer;
             echo "</td>";
             echo "<td>";
             echo $row->stattFach;
             echo "</td>";
             echo "<td>";
             echo $row->Bemerkung;
             echo "</td>";
             echo "</tr>";
           } ?>
         </tr>
       </table>
     </div>
   </section>

 <!--Footer--------------------------------------------------------------------->
   <footer>
     <?php require_once "base/footer.php"; ?>
   </footer>
 </div>
 </body>
 <?php require_once "script/script.html"; ?>
 </html>
