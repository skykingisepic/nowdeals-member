<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!---<html xmlns="http://www.w3.org/1999/xhtml">--->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="NowDeals Verify USDT Sent">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
<title>NowDeals Verify USDT Sent</title>
<link rel="stylesheet" href="styles.css">
</head>

<body>
<center>
<p class="bigtext"><strong>NowDeals<br>Verify USDT Sent</strong></p>

<?php

function gettxhash($txhash) {
//$url = 'https://api.polygonscan.com/api?module=account&action=txlistinternal';
//$url .= '&txhash='.$txhash.'&apikey=WTQ6S62HIF579XYG79W1BN182HSUQ541Z9';
$url = 'https://api.polygonscan.com/api?module=account&action=tokentx';
$url .= '&address=your-wallet-address&startblock=0&endblock=999999999&sort=asc';
$url .= '&page=1&offset=10&apikey=your-api-key';
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, [ 'Content-Type: application/json' ]);

$rtn = curl_exec($curl);

curl_close($curl);
$json = json_decode($rtn, true);
$cnt = count($json['result']);
for ($i = 0; $i < $cnt; $i++) {
  $usdt = $json['result'][$i]['value'];
  $thash = $json['result'][$i]['hash'];
  if ($thash == $txhash) {
    $usdts = ($usdt / 1000000);
  }
}
return $usdts;
}

$sdate = $_SESSION['sdate'];
$edate = $_SESSION['edate'];

$con = new mysqli($_SESSION['dbhost'], $_SESSION['dbuser'], $_SESSION['dbpwd'], $_SESSION['dbname']);
$sql = "SELECT email, usdta, txhash FROM members WHERE (`jdate` BETWEEN '" . $sdate . "' AND '" . $edate . "') ORDER BY jdate, email";

$rtn = $con->query($sql);

$nr = mysqli_num_rows($rtn);
if ($nr > 0) {
   echo '<table><th>eMail</th><th>txhash</th><th>USDT Entered</th><th>USDT Sent</th>';
   $file = fopen('downloads/usdtverif.csv', 'w');

   While ($result = $rtn->fetch_assoc()) {

      $email = $result["email"];
      $txhash = $result["txhash"];
      $usdta = $result["usdta"];

      $sent = gettxhash($txhash);

      if ($sent < ($usdta-2)) {
         echo '<tr><td>' . $result["email"] . '</td>';
         echo '<td>' . $result["txhash"] . '</td>';
         echo '<td>' . $result["usdta"] . '</td>';
         echo '<td>' . $sent . '</td></tr>';
      }
      $data = array( array( $result["email"], $result["usdta"], $result["txhash"], $sent ));
      foreach ($data as $line) { fputcsv($file, $line); }
   }
   echo '</table>';
   echo "<br><br><p><font color='white'>USDT Sent Verification Complete</font></font></p>";
   fclose($file);
} else {
   echo "<br><br><p><font color='red'>Records Not Found by Date Range</font></font></p>";
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


