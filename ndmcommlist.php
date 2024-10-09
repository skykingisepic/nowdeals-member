<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!---<html xmlns="http://www.w3.org/1999/xhtml">--->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="NowDeals Commission List">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
<title>NowDeals Commission List</title>
<link rel="stylesheet" href="styles.css">
</head>

<body>
<center>
<p class="bigtext"><strong>NowDeals<br>Commission List</strong></p>

<?php

$con = new mysqli($_SESSION['dbhost'], $_SESSION['dbuser'], $_SESSION['dbpwd'], $_SESSION['dbname']);
$sql = "SELECT email, jdate, commpend, usdtadd FROM members WHERE commpend > 0";
$sql .= " AND usdtadd !='' ORDER BY jdate, email";
$rtn = $con->query($sql);

$nr = mysqli_num_rows($rtn);
$pend = 0;
//$nr = 12; //test
if ($nr > 0) {
   echo '<table><th>eMail</th><th>Join Date</th><th>Comm Pend</th><th>USDT Receive Address</th>';

   While ($result = $rtn->fetch_assoc()) {
      $pend = $pend + $result["commpend"];
      echo '<tr><td>' . $result["email"] . '</td>';
      echo '<td>' . $result["jdate"] . '</td>';
      echo '<td>' . $result["commpend"] . '</td>';
      echo '<td>' . $result["usdtadd"] . '</td></tr>';
   }
   echo '</table><br><p><font color="white" size= "5">Total Pending is ' . $pend . '</font></p>';
} else {
   echo '<br><br><p><font size= "5"color="white">No Pending Commissions or Missing Addresses</font></p><br><br>';
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


