<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!---<html xmlns="http://www.w3.org/1999/xhtml">--->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="NowDeals MLM Commission Req">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
<title>NowDeals MLM Commission Req</title>
<link rel="stylesheet" href="styles.css">
</head>

<body>
<center>
<p class="bigtext"><strong>NowDeals<br>Commission Payout Required</strong></p>

<?php
$commpend = 0;
if (($handle = fopen("/var/www/html/uploads/mlmcpay.csv", "r")) !== FALSE) {
   while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

      $commpend = $commpend + $data[1];

   }
   fclose($handle);
   echo '</table><br><p><font color="white" size= "5">Total USDT Required is ' . $commpend . '</font></p>';
} else {
   echo '<br><br><p><font size= "5"color="red">csv File Error</font></p><br><br>';
}
?>
<br><br><br><br>
<form action="ndmalogin.php" method="POST">
<button class="button" name="erec">Home</button>
</form>
<img src="NowDealsLogo.png" alt="NowDeals" style="width:107px;height:57px;">
</body>
</html>


