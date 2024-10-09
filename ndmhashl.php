<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!---<html xmlns="http://www.w3.org/1999/xhtml">--->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="NowDeals txHash List">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
<title>NowDeals txHash List</title>
<link rel="stylesheet" href="styles.css">
</head>

<body>
<center>
<p class="bigtext"><strong>NowDeals<br>txHash List</strong></p>

<?php

$sdate = $_SESSION['sdate'];
$edate = $_SESSION['edate'];

$con = new mysqli($_SESSION['dbhost'], $_SESSION['dbuser'], $_SESSION['dbpwd'], $_SESSION['dbname']);
$sql = "SELECT email, tier, usdt, txhash FROM members WHERE (`jdate` BETWEEN '" . $sdate . "' AND '" . $edate . "')";
$sql .= " AND epic = 0 ORDER BY email";
$rtn = $con->query($sql);

$nr = mysqli_num_rows($rtn);
//$nr = 12; //test
if ($nr > 0) {
   echo '<table><th>eMail</th><th>Tier</th><th>USDT</th><th>txHash</th>';

   While ($result = $rtn->fetch_assoc()) {
      echo '<tr><td>' . $result["email"] . '</td>';
      echo '<td>' . $result["tier"] . '</td>';
      echo '<td>' . $result["usdt"] . '</td>';
      echo '<td>' . $result["txhash"] . '</td></tr>';
   }
   echo '</table>';
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


