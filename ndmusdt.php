<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!---<html xmlns="http://www.w3.org/1999/xhtml">--->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="NowDeals USDT Total">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
<title>NowDeals USDT Total</title>
<link rel="stylesheet" href="styles.css">
</head>

<body>
<center>
<p class="bigtext"><strong>NowDeals<br>Get USDT Total</strong></p>

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
$sql = "SELECT usdta FROM members WHERE (`jdate` BETWEEN '" . $sdate . "' AND '" . $edate . "')";
$sql .= " AND epic = 0";
$rtn = $con->query($sql);

$nr = mysqli_num_rows($rtn);
//$nr = 12; //test
if ($nr > 0) {
   create_progress();
   $i = 1;
   $usdta = 0;
   While ($result = $rtn->fetch_assoc()) {
      $pct = round(($i / $nr) * 100);
      update_progress($pct);
      $usdta = $usdta + $result['usdta'];
      /*$tier = $result['tier'];
      if ($tier == "1") {
         $usdt = $usdt + 20;
      }
      if ($tier == "2") {
         $usdt = $usdt + 100;
      }      
      if ($tier == "3") {
         $usdt = $usdt + 200;
      }
      if ($tier == "4") {
         $usdt = $usdt + 500;
      }
      if ($tier == "5") {
         $usdt = $usdt + 1000;
      }*/
      //sleep(2);
      $i++;
   }
   echo '<p><font size="5" color="white">USDT Actually Paid is: <b>' . $usdta . '</font></p></b><br><br>';
} else {
   echo "<br><br><p><font color='red'>Records Not Found by Date Range</font><br><br><font color='tan'>Click Back Button - Try Again</font></p><br><br>";
}
$con -> close();

?>
<br><br><br><br>
<form action="ndmalogin.php" method="POST">
<button class="button" name="erec">Home</button>
</form>
<img src="NowDealsLogo.png" alt="NowDeals" style="width:107px;height:57px;">
</body>
</html>


