<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!---<html xmlns="http://www.w3.org/1999/xhtml">--->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="NowDeals Member Registration">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
<title>NowDeals Member Registration</title>
<link rel="stylesheet" href="styles.css">
</head>

<body>
<center>
<p class="bigtext"><strong>NowDeals<br>Member Registration</strong></p>

<?php
//require 'ndconf.php';
require 'ndsmtp.php';

function randcode() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%*-+';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 10; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

//$refby = $_SESSION['refby'];
$refby = '';
$ip = $_SERVER['REMOTE_ADDR'];
$email = $_POST['email'];
$pwd = $_POST['pwd'];
$phn = $_POST['phn'];
$join = $_POST['jdate'];
$usdt = $_POST['usdt'];
$usdta = $_POST['usdta'];
$hash = $_POST['hash'];
$cntry = $_POST['cntry'];
$radd = $_POST['radd'];
if (isset($_POST['vend'])) { $vend = 1; } else { $vend = 0; }
$refcode = randcode();
$_SESSION['memail'] = $email;
$_SESSION['mpwd'] = $pwd;
//echo '<script>alert("'.$refby.'");</script>';

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
   <form action="ndmember.php" method="POST">
   <button class="button" name="srec">Home</button>
   </form>';
}

$con = new mysqli($_SESSION['dbhost'], $_SESSION['dbuser'], $_SESSION['dbpwd'], $_SESSION['dbname']);
$sql = "SELECT id FROM members WHERE email = '" . $email . "'";
$con->query($sql);
$rtn = $con->query($sql);
if ($rtn) {
   $nr = mysqli_num_rows($rtn);
   if ($nr == 0) {
$sql = "INSERT INTO members (email, phone, pwd, jdate, tier, usdt, txhash, refby, refcode, ";
$sql .= "usdtadd, country, ip, commtot, commpend, usdta, vend) VALUES ('";
$sql .= $email . "', '" . $phn . "', '" . $pwd . "', '";
$sql .= $join . "', '" . $tier . "', " . $usdt . ", '" . $hash . "', '";
$sql .= $refby . "', '" . $refcode . "', '" . $radd . "', '" . $cntry . "', '" . $ip . "', 0, 0, " . $usdta;
$sql .= ", " . $vend . ")";
//echo '<script>alert("'.$sql.'");</script>';
$con->query($sql);
$con -> close();
//echo '<font color="white">Member Record Added</font><br><br>';

//$mail->SMTPDebug = SMTP::DEBUG_SERVER; to mail->IsHTML
$mail->addAddress($email);
$mail->Subject = 'NowDeals Membership';
$hbody = 'Welcome to NowDeals.<br><br>Your membership has now been registered and your password is: ' . $pwd ;
$hbody .= '<br><br>You can use your eMail and Password to view your Membership record at:<br><br>';
$hbody .= '<a href="https://members.nowdeals.com/ndmsrch.php">NowDeals Member Records</a>';
$hbody .= '<br><br>Your sharable link for New Members you want to bring onboard is:';
$hbody .= '<br><br>https://members.nowdeals.com/ndmembnew.php?refcode=' . $refcode;
$hbody .= '<br><br>Copy and save. Use this to earn commissions from new registrations';
$abody = <<<MAIL
Welcome to NowDeals.

Your membership has now been registered and your password is $pwd.

You can use your eMail and Password to view your Membership record at:

https://members.nowdeals.com/ndmsrch.php

Your sharable link for New Members you want to bring onboard is:

https://members.nowdeals.com/ndmembnew.php?refcode=$refcode

Copy and save. Use this to earn commissions from new registrations

MAIL;

$mail->Body    = $hbody;
$mail->AltBody = $abody;

try { 
    $mail->send();
    echo '<p><font size="5" color="white">Record Created and eMail Sent</font></p>';
} catch (Exception $e) {
    echo '<p><font size="5" color="white">Record Created but Mailer Error: ' . $mail->ErrorInfo . '</font></p>';
}

} else {
   echo '<p><font size="5" color="red">eMail Address Already Exists</font></p><br><br>';
}
} else {
    echo '<p><font size="5" color="red">SQL Error: ' . mysqli_error();
}

?>
<br>
<form action="ndmember.php" method="POST">
<button class="button" name="srec">Home</button>
</form>
<img src="NowDealsLogo.png" alt="NowDeals" style="width:107px;height:57px;">
</body>
</html>

