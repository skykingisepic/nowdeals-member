<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!---<html xmlns="http://www.w3.org/1999/xhtml">--->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="NowDeals Set Commissions">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
<title>NowDeals Set Commissions</title>
<link rel="stylesheet" href="styles.css">
</head>

<body>
<center>
<p class="bigtext"><strong>NowDeals<br>Set Commissions</strong></p>
<br><br><br>
<?php

function create_progress() {
   echo "
<div id='barbox_a'></div>
<div class='bar blank'></div>
<div class='per'>0%</div>
";

  // Ensure that this gets to the screen
  // immediately:
  ob_flush();
  flush();
}

function update_progress($percent) {
  // First let's recreate the percent with
  // the new one:
  echo "<div class='per'>{$percent}
    %</div>\n";

  // Now, output a new 'bar', forcing its width
  // to 3 times the percent, since we have
  // defined the percent bar to be at
  // 300 pixels wide.
  echo "<div class='bar' style='width: ",
    $percent * 3, "px'></div>\n";

  // Now, again, force this to be
  // immediately displayed:
  ob_flush();
  flush();
}

//header( 'X-Accel-Buffering: no' );

$sdate = $_SESSION['sdate'];
$edate = $_SESSION['edate'];

$con = new mysqli($_SESSION['dbhost'], $_SESSION['dbuser'], $_SESSION['dbpwd'], $_SESSION['dbname']);
$sql = "SELECT id, usdt, refby, commpend, commtot FROM members ";
$sql .= "WHERE (jdate BETWEEN '" . $sdate . "' AND '" . $edate . "') AND NOT commdone";
$rtn = $con->query($sql);

$nr = mysqli_num_rows($rtn);
//echo '<script>alert("'.$nr.'");</script>';
if ($nr > 0) {
   create_progress();
   $i = 1;
   //new members
   while ($result = $rtn->fetch_assoc()) {
      $pct = round(($i / $nr) * 100);
      $id = $result['id'];
      $usdt = $result['usdt'];
      $refby = $result['refby'];
      $commpend = $result['commpend'];
      $commtot = $result['commtot'];

      if ($refby == 'nowdeals') {
         $sql = "UPDATE members SET commdone = 1 WHERE id = '" . $id . "'";
         $con->query($sql); //set commdone so no duplicate updates
         $i++; 
         continue ; //no upline referring member
      }
      $lvl = 1;
      while ($lvl < 4) {
         //find referrer - don't process if inactive or has no referred by code (nowdeals default)
         $sql = "SELECT act, tier, refby, refcode, commpend, commtot FROM members WHERE refcode = '" . $refby . "'";
         $rtnl = $con->query($sql);
         $nrl = mysqli_num_rows($rtnl);

         if ($nrl == 0) { $lvl++; continue ; } //no upline referring member

         $result = $rtnl->fetch_assoc();
         $act = $result['act'];
         $tier = $result['tier'];
         $refby = $result['refby'];
         $refcode = $result['refcode'];
         $commpend = $result['commpend'];
         $commtot = $result['commtot'];

         if ($lvl == 1) {
            if ($tier !== "0" && $tier !== "6" && $act == 1) {
               $commpend = $commpend + ($usdt * .1); //update pending in case not cleared by payout
               $commtot = $commtot + ($usdt * .1); //update total commission
               $sql = "UPDATE members SET commpend = " . $commpend . ", commtot = " . $commtot;
               $sql .= " WHERE refcode = '" . $refcode . "'";
               $con->query($sql);
            }
         }
         if ($lvl == 2) {
            if ($tier == "3" || $tier == "4" && $act == 1) {
               $commpend = $commpend + ($usdt * .03);
               $commtot = $commtot + ($usdt * .03);
               $sql = "UPDATE members SET commpend = " . $commpend . ", commtot = " . $commtot;
               $sql .= " WHERE refcode = '" . $refcode . "'";
               $con->query($sql);
            }
            if ($tier == "5" && $act == 1) {
               $commpend = $commpend + ($usdt * .05);
               $commtot = $commtot + ($usdt * .05);
               $sql = "UPDATE members SET commpend = " . $commpend . ", commtot = " . $commtot;
               $sql .= " WHERE refcode = '" . $refcode . "'";
               $con->query($sql);
            }
         }
         if ($lvl == 3) {
            if ($tier == "4" && $act == 1) {
               $commpend = $commpend + ($usdt * .01);
               $commtot = $commtot + ($usdt * .01);
               $sql = "UPDATE members SET commpend = " . $commpend . ", commtot = " . $commtot;
               $sql .= " WHERE refcode = '" . $refcode . "'";
               $con->query($sql);
            }
            if ($tier == "5" && $act == 1) {
               $commpend = $commpend + ($usdt * .03);
               $commtot = $commtot + ($usdt * .03);
               $sql = "UPDATE members SET commpend = " . $commpend . ", commtot = " . $commtot;
               $sql .= " WHERE refcode = '" . $refcode . "'";
               $con->query($sql);
            }
         }
         if ($refby == 'nowdeals') { //no upline members to credit
            $lvl = 4;
         } else { 
            $lvl++;
         }
         if ($lvl == 4) {
            $sql = "UPDATE members SET commdone = 1 WHERE id = '" . $id . "'";
            $con->query($sql); //set commdone so no duplicate updates
            break;
         }
      } //end lvl loop
      update_progress($pct);
      $i++;
   } // end while - get new records
   echo '<br><p><font color="white" size="5">Commissions Updated</p>';
} else {
   echo "<br><br><p><font color='red' size='5'>Commissions Already Set</font>";
   echo "<br><br><font color='tan'>Try Again</font></p><br><br>";
} //nr>0
$con -> close();
?>
<form action="ndmalogin.php" method="POST">
<button class="button" name="erec">Home</button>
</form>
<br><br>
<img src="NowDealsLogo.png" alt="NowDeals" style="width:107px;height:57px;">
</body>
</html>


