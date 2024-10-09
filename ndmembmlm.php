<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="NowDeals Import MLM Members">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
<title>NowDeals Import MLM Members</title>
<link rel="stylesheet" href="styles.css">
</head>

<body>
<center>
<p class="bigtext"><strong>NowDeals<br>Import MLM Members</strong></p>

<?php
require 'ndconf.php';
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

$con = new mysqli($_SESSION['dbhost'], $_SESSION['dbuser'], $_SESSION['dbpwd'], $_SESSION['dbname']);

// read csv file
$row = 1;
if (($handle = fopen("/var/www/html/uploads/mlmnew.csv", "r")) == FALSE) {
   echo '<br><p><font size="5" color="red">File Open Error - mlmnew.csv</font></p>';
   echo '<br><form action="ndmalogin.php" method="POST">
         <button class="button" name="srec">Home</button></form>';
}
while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
   $num = count($data);
   if ($num !== 7) { continue; }
   //$num = count($data);
   $email = $data[0];
   $join = $data[1];
   $cntry = $data[2];
   $usdt = $data[3];
   $usdta = $data[4];
   $hash = $data[5];
   $radd = $data[6];
    
   if ($usdt != "0" && $usdt != "100" && $usdt != "500" && $usdt != "1000" && $usdt != "2500" && $usdt != "5000") {
      continue;
   }
   // create record with above data

   $refby = 'mlmgrp'; //or 'nowdeals'
   $ip = '';
   $pwd = randcode();
   $phn = '';
   //$join = date('Y-m-d');
   $refcode = randcode();
   $_SESSION['memail'] = $email;
   $_SESSION['mpwd'] = $pwd;

   switch ($usdt) {
      case "0": $tier = '0'; break;
      case "100": $tier = '1'; break;
      case "500": $tier = '2'; break;
      case "1000": $tier = '3'; break;
      case "2500": $tier = '4'; break;
      case "5000": $tier = '5';
   }

//} else {
//  echo '<p><font size="5" color="red">Invalid USDT Paid<br>Enter Registration Again</font></p><br><br>
//   <br>
//   <form action="ndmember.php" method="POST">
//   <button class="button" name="srec">Home</button>
//   </form>';
//}

   $sql = "SELECT id FROM members WHERE email = '" . $email . "'";
   $con->query($sql);

   $rtn = $con->query($sql);
   $nr = mysqli_num_rows($rtn);
   if ($nr == 0) {
       '<p><font size="5" color="white">' . $email;
      echo '<br><p><font size="5" color="red">Address Already Exists - Not Added</font></p>';
      continue; // email Address Already Exists
   }

$sql = "INSERT INTO members (email, phone, pwd, jdate, tier, usdt, txhash, refby, refcode, ";
$sql .= "usdtadd, country, ip, commtot, commpend, usdta) VALUES ('" . $email . "', '" . $phn . "', '" . $pwd . "', '";
$sql .= $join . "', '" . $tier . "', " . $usdt . ", '" . $hash . "', '";
$sql .= $refby . "', '" . $refcode . "', '" . $radd . "', '" . $cntry . "', '" . $ip . "', 0, 0, '" . $usdta . "')";
//echo '<script>alert("'.$sql.'");</script>';
   $con->query($sql);

//$mail->SMTPDebug = SMTP::DEBUG_SERVER; to mail->IsHTML
   $mail->addAddress($email);
   $mail->Subject = 'NowDeals Membership';
$hbody = 'Welcome to NowDeals.<br><br>Your membership has now been registered and your password is: ' . $pwd ;
$hbody .= '<br><br>You can use your eMail and Password to view your Membership record at:<br><br>';
$hbody .= '<a href="https://members.nowdeals.com/ndmsrch.php">NowDeals Member Records</a>';
//$hbody .= '<br><br>Your sharable link for New Members you want to bring onboard is:';
//$hbody .= '<br><br>https://members.nowdeals.com/ndmembnew.php?refcode=' . $refcode;
//$hbody .= '<br><br>Copy and save. Use this to earn commissions from new registrations';
$abody = <<<MAIL
Welcome to NowDeals.

Your membership has now been registered and your password is $pwd.

You can use your eMail and Password to view your Membership record at:

https://members.nowdeals.com/ndmsrch.php


MAIL;
//Your sharable link for New Members you want to bring onboard is:

//https://members.nowdeals.com/ndmembnew.php?refcode=$refcode

//Copy and save. Use this to earn commissions from new registrations

   $mail->Body    = $hbody;
   $mail->AltBody = $abody;
   $mail->send();

} // end while csv file read
    echo '<p><font color="white">Member Import Complete';
    fclose($handle);
//} // end open csv no error
$con -> close();
?>
<br>
<form action="ndmalogin.php" method="POST">
<button class="button" name="srec">Home</button>
</form>
<br>
<img src="NowDealsLogo.png" alt="NowDeals" style="width:107px;height:57px;">
</body>
</html>

