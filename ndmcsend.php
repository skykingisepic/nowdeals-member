<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!---<html xmlns="http://www.w3.org/1999/xhtml">--->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="NowDeals Send Address Reminder">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
<title>NowDeals Send Address Reminder</title>
<link rel="stylesheet" href="styles.css">
</head>

<body>
<center>
<p class="bigtext"><strong>NowDeals<br>Send Address Reminder</strong></p>

<?php
require 'ndsmtp.php';

function create_progress() {

   echo "
<p><font color='white'>Sending eMails...</font></p>
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

$con = new mysqli($_SESSION['dbhost'], $_SESSION['dbuser'], $_SESSION['dbpwd'], $_SESSION['dbname']);
$sql = "SELECT email, commpend FROM members WHERE commpend > 0 and usdtadd = ''";
$rtn = $con->query($sql);

$mail->Subject = 'NowDeals Commission Reminder';

$nr = mysqli_num_rows($rtn);

if ($nr > 0) {
   create_progress();
   $i = 1;
   While ($result = $rtn->fetch_assoc()) {
      $pct = round(($i / $nr) * 100);
      update_progress($pct);
      $commpend = $result['commpend'];
      echo '<br><p><font size= "4"color="white">' . $result['email'] . '</font></p>';
      $mail->addAddress($result['email']);
      $hbody = 'NOTICE: You have a pending Commission Payout of ' . $commpend;
      $hbody .= '<br><br>However, your USDT Receive Address is Missing.';
      $hbody .= '<br><br>Please go to the Member Portal and enter your USDT Receive Address';
      $hbody .= '<br><br><a href="https://members.nowdeals.com/ndmember.php"></a>';
$abody = <<<MAIL
NOTICE: You have a pending Commission Payout of $commpend

However, your USDT Receive Address is Missing

Please go to the Member Portal and enter your USDT Receive Address

https://members.nowdeals.com/ndmember.php
MAIL;
      $mail->Body    = $hbody;
      $mail->AltBody = $abody;
      $mail->send();
      sleep(1);
      $mail->ClearAllRecipients();
      $i++;
   }
   echo '<br><br><br><p><font size="5" color="white">eMails Sent</font><p><br>';
} else {
   echo '<br><br><br><p><font size="5" color="red">Records Not Found</font><br><br><font color="tan">Try Again</font></p><br>';
}
$con -> close();
?>
<form action="ndmalogin.php" method="POST">
<button class="button" name="erec">Home</button>
</form>
<br>
<img src="NowDealsLogo.png" alt="NowDeals" style="width:107px;height:57px;">
</body>
</html>


