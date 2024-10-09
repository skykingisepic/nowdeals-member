<?php session_start(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!---<html xmlns="http://www.w3.org/1999/xhtml">--->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="NowDeals Member Info">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
<title>NowDeals Member Info</title>
<link rel="stylesheet" href="styles.css">
</head>

<body>
<center>
<p class="bigtext"><strong>NowDeals<br>Member Info</strong></p>

<?php
require 'ndconf.php';
//$login = $_SESSION['login'];
$email = $_SESSION['memail'];
$pwd = $_SESSION['mpwd'];

$con = new mysqli($_SESSION['dbhost'], $_SESSION['dbuser'], $_SESSION['dbpwd'], $_SESSION['dbname']);
$sql = "SELECT * FROM members WHERE (email = '".$email."' AND pwd = '".$pwd."')";
$rtn = $con->query($sql);

if (mysqli_num_rows($rtn) > 0) {
   $result = $rtn->fetch_assoc();
   echo "<p><font color=tan>eMail<br><font color=aqua>".$result['email']."</p>";
   echo "<p><font color=tan>Phone<br><font color=aqua>".$result['phone']."</p>";
   echo "<p><font color=tan>Password<br><font color=aqua>".$result['pwd']."</p>";
   echo "<p><font color=tan>Join Date<br><font color=aqua>".$result['jdate']."</p>";
   echo "<p><font color=tan>Referrer<br><font color=aqua>".$result['refby']."</p>";
   echo "<p><font color=tan>Referral Code<br><font color=aqua>".$result['refcode']."</p>";
   echo "<p><font color=tan>Country<br><font color=aqua>".$result['country']."</p>";
   echo "<p><font color=green>"; if ($result['act'] == 1) { echo "Active"; } else { echo "Inactive"; }
   echo "<p><font color=green>"; if ($result['vend'] == 1) { echo "Vendor"; } else { echo "Not Vendor"; }
   echo "<p><font color=tan>Tier Level<br><font color=aqua>";
   switch ($result['tier']) {
      case "0": echo "Free"; break;
      case "1": echo "Starter"; break;
      case "2": echo "Trader"; break;
      case "3": echo "Trader Pro"; break;
      case "4": echo "Tycoon"; break;
      case "5": echo "Tycoon Plus"; break;
   }
   echo "</p>";
   echo "<p><font color=tan>USDT Required for Tier<br><font color=aqua>".$result['usdt']."</p>";
   echo "<p><font color=tan>USDT Actually Paid<br><font color=aqua>".$result['usdta']."</p>";
   echo "<p><font color=tan>USDT tx hash<br><font color=aqua>".$result['txhash']."</p>";
   echo "<p><font color=tan>USDT Receive Address<br><font color=aqua>".$result['usdtadd']."</p>";
   echo "<p><font color=tan>Commission Pending USDT<br><font color=aqua>".$result['commpend']."</p>";
   echo "<p><font color=tan>Commission Received USDT<br><font color=aqua>".$result['commtot']."</p>";
   echo "<p><font color=tan>Exch Rate USDT<br><font color=aqua>".$result['erate']."</p>";
   echo "<p><font color=tan>Exch Date<br><font color=aqua>".$result['edate']."</p>";
   echo "<p><font color=tan>Epic Bal<br><font color=aqua>".$result['epic']."</p>";
} else {
   echo "<br><br><p><font color='red'>Record Not Found</font><br><br><font color='tan'>Click Back Button - Try Again</font></p><br><br>";
}
$con -> close();
if (!isset($_SESSION['login'])) {
   echo '<br><form action="ndmembedit.php" method="POST">
<button class="button" name="srch">Edit Info</button>
</form>
<br>
<form action="ndmember.php" method="POST">
<button class="button" name="srch">Home</button>
</form>';
} else {
echo '<form action="ndmalogin.php" method="POST">
<button class="button" name="srch">Home</button>
</form>';
}
?>
<br><br>
<img src="NowDealsLogo.png" alt="NowDeals" style="width:107px;height:57px;">
</body>
</html>


