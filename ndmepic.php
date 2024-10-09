<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!---<html xmlns="http://www.w3.org/1999/xhtml">--->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="NowDeals Set Epic">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
<title>NowDeals Set Epic</title>
<link rel="stylesheet" href="styles.css">
</head>

<body>
<center>
<p class="bigtext"><strong>NowDeals<br>Set Epic</strong></p>
<br><br><br>
<?php

function create_progress() {
   echo "
<div id='barbox_a'></div>
<div class='bar blank'></div>
<div class='per'>0%</div>
";

  ob_flush();
  flush();
}

function update_progress($percent) {
  echo "<div class='per'>{$percent}
    %</div>\n";

  echo "<div class='bar' style='width: ",
    $percent * 3, "px'></div>\n";

  ob_flush();
  flush();
}

$sdate = $_SESSION['sdate'];
$edate = $_SESSION['edate'];
$erate = $_SESSION['erate'];
$exdate = $_SESSION['exdate'];

$con = new mysqli($_SESSION['dbhost'], $_SESSION['dbuser'], $_SESSION['dbpwd'], $_SESSION['dbname']);
$sql = "SELECT email, usdta FROM members WHERE (jdate BETWEEN '" . $sdate . "' AND '" . $edate . "')";
$rtn = $con->query($sql);
$con -> close();

$nr = mysqli_num_rows($rtn);
if ($nr > 0) {
   create_progress();
   $i = 1;
   While ($result = $rtn->fetch_assoc()) {
      $pct = round(($i / $nr) * 100);
      update_progress($pct);
      $memail = $result['email'];
      $epic = (($result['usdta']*.2) / $erate);
      //$tier = $result['tier'];
      //$erate = $result['erate'];
      /*if ($tier == "1") {
         $epic = 20 / $erate ;
      }
      if ($tier == "2") {
         $epic = 100 / $erate ;
      }      
      if ($tier == "3") {
         $epic = 200 / $erate ;
      }
      if ($tier == "4") {
         $epic = 500 / $erate ;
      }
      if ($tier == "5") {
         $epic = 1000 / $erate ;
      }*/
     
      $con = new mysqli($_SESSION['dbhost'], $_SESSION['dbuser'], $_SESSION['dbpwd'], $_SESSION['dbname']);
      $sql = "UPDATE members SET epic = '" . $epic . "', erate = '" . $erate . "', edate = '" . $edate . "'";
      $sql .= ", act = 1 WHERE email = '" . $memail . "' AND epic = 0";
      //echo '<script>alert("'.$sql.'");</script>';
      $con->query($sql);
      $con -> close();
      $i++;
   }
   echo '<br><p><font color="white" size="5">Epic Updated</p>';
} else {
   echo "<br><br><p><font color='red'>Records Not Found by Date Range</font><br><br><font color='tan'>Click Back Button - Try Again</font></p><br><br>";
}

?>
<form action="ndmalogin.php" method="POST">
<button class="button" name="erec">Home</button>
</form>
<br><br>
<img src="NowDealsLogo.png" alt="NowDeals" style="width:107px;height:57px;">
</body>
</html>


