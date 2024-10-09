<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!---<html xmlns="http://www.w3.org/1999/xhtml">--->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="NowDeals Send Member eMail">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
<title>NowDeals Send Member eMail</title>
<link rel="stylesheet" href="styles.css">
</head>

<body>
<center>
<p class="bigtext"><strong>NowDeals<br>Send Epic eMails</strong></p>

<?php
require 'ndsmtp.php';

function create_progress() {
  // First create our basic CSS that will control
  // the look of this bar: <div id='text'>

   echo "
<p><font color='white'>Sending eMails...</font></p>
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
// use PHP to $mail = 

//header('Content-type: text/html; charset=utf-8');
//header("Cache-Control: no-cache, must-revalidate");
//header( 'X-Accel-Buffering: no' );

$sdate = $_SESSION['sdate'];
$edate = $_SESSION['edate'];

$con = new mysqli($_SESSION['dbhost'], $_SESSION['dbuser'], $_SESSION['dbpwd'], $_SESSION['dbname']);
$sql = "SELECT email, erate, edate, epic FROM members WHERE (`jdate` BETWEEN '" . $sdate . "' AND '" . $edate . "')";
$sql .= " ORDER BY email";
$rtn = $con->query($sql);

//$mail->SMTPDebug = SMTP::DEBUG_SERVER; to mail->IsHTML
$mail->Subject = 'NowDeals Membership Epic';

$nr = mysqli_num_rows($rtn);
//$nr = 12; //test
if ($nr > 0) {
   create_progress();
   $i = 1;
   //$result = $rtn->fetch_assoc(); //test
   //While ($i < ($nr + 1)) { //test
   While ($result = $rtn->fetch_assoc()) {
      $pct = round(($i / $nr) * 100);
      update_progress($pct);
      $memepic = $result['epic'];
      $memedate = $result['edate'];
      $memerate = $result['erate'];
      $mail->addAddress($result['email']);
      $hbody = 'Welcome to NowDeals.<br><br>Your membership Epic has now been purchased and your Balance is: ' . $memepic ;
      $hbody .= '<br><br>Purchased on ' . $memedate;
      $hbody .= '<br><br>With an Exchange Rate of ' . $memerate . ' USDT';
      $hbody .= '<br><br>It will be held in Reserve for you for 6 months';
$abody = <<<MAIL
Welcome to NowDeals.

Your membership Epic has now been purchased and your Balance is $memepic

Purchased on $memedate

With an Exchange Rate of $memerate USDT

It will be held in Reserve for you for 6 months
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
   echo '<br><br><br><p><font size="5" color="red">Records Not Found by Date Range</font><br><br><font color="tan">Click Back Button - Try Again</font></p><br>';
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


