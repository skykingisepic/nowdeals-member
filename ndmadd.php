<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!---<html xmlns="http://www.w3.org/1999/xhtml">--->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="NowDeals Add Member">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
<title>NowDeals Add Member</title>
<link rel="stylesheet" href="styles.css">
</head>

<body>
<center>
<p class="bigtext"><strong>NowDeals<br>Add a Member</strong></p>

<?php
require 'ndsmtp.php';

session_start();
$login = $_SESSION['login'];
if (!isset($_SESSION['login'])) {
   $_SESSION['bp'] = 'y';
   header("Location: ndmalogin.php");
}
if ($login !== $_SESSION['admin']) {
   $_SESSION['bp'] = 'y';
   header("Location: ndmalogin.php");
}
// use PHP to $mail = 

$email = $_POST['email'];
$pwd = $_POST['pwd'];
$phn = $_POST['phn'];
$join = $_POST['jdate'];
$cntry = $_POST['cntry'];
$usdt = $_POST['usdt'];
$usdta = $_POST['usdta'];
$hash = $_POST['hash'];
if (isset($_POST['vend'])) { $vend = 1; } else { $vend = 0; }
$_SESSION['memail'] = $email;
$_SESSION['mpwd'] = $pwd;

if ($usdt != "0" && $usdt != "100" && $usdt != "500" && $usdt != "1000" && $usdt != "2500" && $usdt != "5000") {
  $uval = false;
} else { $uval = true; }

if ($uval == true) {
   switch ($usdt) {
      case "0": $tier = '0'; break;
      case "100": $tier = '1'; break;
      case "500": $tier = '2'; break;
      case "1000": $tier = '3'; break;
      case "2500": $tier = '4'; break;
      case "5000": $tier = '5';
   }
} else {
  echo '<p><font size="5" color="red">Invalid USDT Paid<br>Enter Registration Again</font></p><br><br>
   <br>
   <form action="ndalogin.php" method="POST">
   <button class="button" name="srec">Home</button>
   </form>';
}

$con = new mysqli($_SESSION['dbhost'], $_SESSION['dbuser'], $_SESSION['dbpwd'], $_SESSION['dbname']);

$sql = "SELECT id FROM members WHERE email = '" . $email . "'";
//echo '<script>alert("'.$sql.'");</script>';
$rtn = $con->query($sql);
if ($rtn) {
   $nr = mysqli_num_rows($rtn);
   if ($nr == 0) {
$sql = "INSERT INTO members (email, phone, pwd, jdate, tier, usdt, txhash, usdta, cntry, vend) VALUES ('";
$sql .= $email . "', '" . $phn . "', '" . $pwd . "', '" . $join . "', '" . $tier . "', " . $usdt . ", '" . $hash;
$sql .= "', " . $usdta . ", '" . $cntry . "', " . $vend . ")";
//echo '<script>alert("'.$sql.'");</script>';
$con->query($sql);
$con -> close();

//$mail->SMTPDebug = SMTP::DEBUG_SERVER; to mail->IsHTML
$mail->Subject = 'NowDeals Membership';
$hbody = 'Welcome to NowDeals.<br><br>Your membership has now been registered and your password is: ' . $pwd ;
$hbody .= '<br><br>You can use your eMail and Password to view your Membership record at:<br><br>';
$hbody .= '<a href="https://members.nowdeals.com/ndmsrch.php">NowDeals Member Records</a>';
$abody = <<<MAIL
Welcome to NowDeals.

Your membership has now been registered and your password is $pwd.

You can use your eMail and Password to view your Membership record at:

https://members.nowdeals.com/ndmsrch.php
MAIL;
$mail->Body    = $hbody;
$mail->AltBody = $abody;

if (!$mail->send()) {
    echo '<p><font size="5" color="white">Record Created but Mailer Error: ' . $mail->ErrorInfo . '</font></p>';
} else {
    echo '<p><font size="5" color="white">Record Created and eMail Sent</font></p><br><br>';
}

} else {
   echo '<p><font size="5" color="red">eMail Address Already Exists</font></p><br><br>';
}

} else {
    echo '<p><font size="5" color="red">SQL Error: ' . mysqli_error();
}
?>
<br>
<form action="ndmalogin.php" method="POST">
<button class="button" name="srec">Home</button>
</form>
<br>
<form action="ndmembadd.php" method="POST">
<button class="button" name="arec">Add New Record</button>
</form>
<img src="NowDealsLogo.png" alt="NowDeals" style="width:107px;height:57px;">
</body>
</html>

