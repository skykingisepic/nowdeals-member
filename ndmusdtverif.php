<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="NowDeals USDT Verification">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
<title>NowDeals USDT Verification</title>
<link rel="stylesheet" href="styles.css">
</head>

<body>
<center>
<p class="bigtext"><strong>NowDeals<br>USDT Verification</strong></p>

<?php

function create_progress() {
   echo "
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

$sdate = $_SESSION['sdate'];
$edate = $_SESSION['edate'];

$con = new mysqli($_SESSION['dbhost'], $_SESSION['dbuser'], $_SESSION['dbpwd'], $_SESSION['dbname']);
$sql = "SELECT email, usdt, txhash FROM members WHERE (`jdate` BETWEEN '" . $sdate . "' AND '" . $edate . "')";
$sql .= " AND epic = 0";
$rtn = $con->query($sql);

$nr = mysqli_num_rows($rtn);

if ($nr > 0) {
   create_progress();
   $i = 1;
   
   While ($result = $rtn->fetch_assoc()) {
      $pct = round(($i / $nr) * 100);
      update_progress($pct);
      $txhash = $result['txhash'];
      $usdt = $result['usdt'];
      $email = $result['email'];

      // Use API to get usdt from txhash
      $url = 'https://api.polygonscan.com/api
      ?module=account
      &action=txlistinternal
      &txhash=' . $txhash . '
      &apikey=YourApiKeyToken';

      $curl = curl_init($url);

      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_HTTPHEADER, [ 'Content-Type: application/json' ]);

      $response = curl_exec($curl);
      curl_close($curl);

      $part1 = strchr($response,"value");
      //print_r($part1."</br>");
      $part2 = substr($part1,7);
      //print_r($part2."</br>");
      $endpos = strpos($part2,"cont");
      //print_r($endpos."</br>");
      $usdtsent = substr($part2,0,$endpos-2);

      if (($usdtsent / 100000) < ($usdt) {
         echo '<p><font color="white">eMail: ' . $email . 'Reported: ' . $usdt;
         echo ' Sent: <font color="red">' . ($usdtsent / 100000) . '<br>';
      }
      $i++;
   }
   echo '<p><font size="5" color="white">Verification Complete</font></p></b><br><br>';
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


