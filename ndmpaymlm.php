<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!---<html xmlns="http://www.w3.org/1999/xhtml">--->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="NowDeals Send MLM Commissions">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
<title>NowDeals Send MLM Commissions</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<center>
<p class="bigtext"><strong>NowDeals<br>Send MLM Commissions</strong></p>
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

// Connect to Polygon node (e.g., via Infura)

$sweb3 = new SWeb3("https://polygon-mainnet.infura.io/v3/infura-api-key");

// Define your wallet private key and contract details
$privKey = "send-wallet-priv-key";
$fromAdd = "send-wallet-address";
$usdtContAdd = "send-wallet-contract";
$sweb3->chainId = 137; //Polygon Network mainnet

// USDT contract ABI (simplified with only the 'transfer' function)
$usdtAbi = '[{"constant":false,"inputs":[{"name":"_to","type":"address"},{"name":"_value","type":"uint256"}],"name":"transfer","outputs":[{"name":"","type":"bool"}],"type":"function"}]';

// Set Personal Data
$sweb3->setPersonalData($fromAdd, $privKey);

// Initialize contract - Note the correct instantiation of the contract class
$contract = new SWeb3_Contract($sweb3, $usdtContAdd, $usdtAbi);

// Prepare the transaction data
$extra_data = [ 'nonce' => $sweb3->personal->getNonce(), 'gasLimit' => '100000' ];

create_progress();

echo '<table><th>Member eMail</th><th>USDT Addr</th><th>tx Hash</th>';
$file = fopen('/var/www/html/members/downloads/commpaid-'.date('Y-m-d').'.csv', 'w');

//   while ($result = $rtn->fetch_assoc()) {
if (($handle = fopen("/var/www/html/uploads/mlmcpay.csv", "r")) == FALSE) {
   echo '<p><font color="red" size="5">csv File Open Error - mlmcpay.csv</p>';
   echo '<br><form action="ndmalogin.php" method="POST">';
   echo '<button class="button" name="home">Home</button></form>';
} 
while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
   $num = count($data);
   if ($num !== 3) { continue; }
   $email = $data[0];
   $usdtadd = $data[1];
   $commpend = $data[2] . "000000";

   $pct = round(($i / $nr) * 100);

   $result = $contract->send('transfer', [$usdtadd, $commpend], $extra_data);

   $json = (array)($result);
   $rslt = '';
   foreach($json as $key => $value) {
      if ($key == 'result') { $rslt = $value; }
   }

   $data = array( array( $email, $usdtadd, $rslt ));
   foreach ($data as $line) { fputcsv($file, $line); }

   echo '<tr><td>' . $email . '<tr><td>' . $usdtadd . '</td><td>' . $rslt . '</td></tr>';

   update_progress($pct);
   $i++;
} // end while - get csv records
echo '</table><br>';
fclose($file);
echo '<p><font color="white" size="5">Commissions Paid</p>';
fclose($handle);

?>

<br>
<form action="ndmalogin.php" method="POST">
<button class="button" name="home">Home</button>
</form>
<img src="NowDealsLogo.png" alt="NowDeals" style="width:107px;height:57px;">
</body>
</html>


