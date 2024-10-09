<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!---<html xmlns="http://www.w3.org/1999/xhtml">--->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="NowDeals Send Pending Commissions">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
<title>NowDeals Send Pending Commissions</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<center>
<p class="bigtext"><strong>NowDeals<br>Send Pending Commissions</strong></p>
<br><br><br>
<form method="POST">
<br><br><br>
<!---<label class="label" for="pkey">Private Key: (cleared after send complete)</label><br>
<input class="input" type="text" id="pkey" name="pkey" size="41" maxlength="40"><br><br>--->
<button class="button" name="pcb">Pay Commissions</button>
</form>
<br><br>

<?php

require_once('vendor/autoload.php');

use stdClass;
use SWeb3\Utils;
use SWeb3\SWeb3;
use SWeb3\SWeb3_Contract;

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

if (array_key_exists('pcb',$_POST)) {

// Connect to Ethereum node (e.g., via Infura)
//$providerUrl = "https://polygon-mainnet.infura.io/v3/f2c0c1563cf947df92a967fbfd07fbc5";
$sweb3 = new SWeb3("https://polygon-mainnet.infura.io/v3/f2c0c1563cf947df92a967fbfd07fbc5");

// Define your wallet private key and contract details
$privKey = "6862d67cda79b91009216c3d670c7b2e8d2ca283d9bd24eff660b72ce331ecaa";
$fromAdd = "0xAB0874D3e7Cd256Cd3F1A9480c3b0C01109E2117";
//$toAddress = $usdtadd;
$usdtContAdd = "0xdAC17F958D2ee523a2206206994597C13D831ec7";
$sweb3->chainId = 137; //Polygon Network mainnet

// USDT contract ABI (simplified with only the 'transfer' function)
$usdtAbi = '[{"constant":false,"inputs":[{"name":"_to","type":"address"},{"name":"_value","type":"uint256"}],"name":"transfer","outputs":[{"name":"","type":"bool"}],"type":"function"}]';

// Set Personal Data
$sweb3->setPersonalData($fromAdd, $privKey);

// Initialize contract - Note the correct instantiation of the contract class
$contract = new SWeb3_Contract($sweb3, $usdtContAdd, $usdtAbi);

// Prepare the transaction data
$extra_data = [ 'nonce' => $sweb3->personal->getNonce(), 'gasLimit' => '100000' ];

$con = new mysqli($_SESSION['dbhost'], $_SESSION['dbuser'], $_SESSION['dbpwd'], $_SESSION['dbname']);
$sql = "SELECT email, usdtadd, commpend FROM members WHERE commpend > 0 AND usdtadd != ''";
$rtn = $con->query($sql);

$nr = mysqli_num_rows($rtn);
$i=1;

if ($nr > 0) {

   create_progress();

   echo '<table><th>Member eMail</th><th>tx Hash</th>';
   $file = fopen('/var/www/html/uploads/mlmcpay.csv', 'w');

   while ($result = $rtn->fetch_assoc()) {

      $pct = round(($i / $nr) * 100);

      $email = $result['email'];
      $usdtadd = $result['usdtadd'];
      $commpend = $result['commpend'] . "000000"; //USDT 6 dec places

      //$result = $contract->send('transfer', [$usdtadd, $commpend], $extra_data);

      $data = array( array( $email, $result['txHash'] ));
      foreach ($data as $line) { fputcsv($file, $line); }

      echo '<tr><td>' . $email . '</td><td>' . $result['txHash'] . '</td></tr>';

      update_progress($pct);
      $i++;
   } // end while - get new records
   echo '</table><br>';
   fclose($file);

   $sql = "UPDATE members SET commpend = 0 WHERE commpend > 0 AND usdtadd !=''";
   $con->query($sql);
   
   echo '<p><font color="white" size="5">Commissions Paid</p>';
} else {
   echo "<br><p><font color='red' size='5'>Commissions Already Paid or<br>Missing USDT Address</font>";
   echo "<br><font color='tan'>Try Later</font></p><br><br>";
} //endif nr>0
$con -> close();
}
?>

<br>
<form action="ndmalogin.php" method="POST">
<button class="button" name="home">Home</button>
</form>
<img src="NowDealsLogo.png" alt="NowDeals" style="width:107px;height:57px;">
</body>
</html>


