<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!---<html xmlns="http://www.w3.org/1999/xhtml">--->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="NowDeals Member Edit">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
<title>NowDeals Member Edit</title>
<link rel="stylesheet" href="styles.css">
</head>

<body>
<center>
<p class="bigtext"><strong>NowDeals Admin<br>Member Edit</strong></p>
<?php

if (!isset($_SESSION['login'])) {
   $_SESSION['bp'] = 'y';
   header("Location: ndmalogin.php");
} else {
   $login = $_SESSION['login'];
   if ($login !== $_SESSION['admin']) {
      $_SESSION['bp'] = 'y';
      header("Location: ndmalogin.php");
   }
}
$email = $_SESSION['memail'];

$con = new mysqli($_SESSION['dbhost'], $_SESSION['dbuser'], $_SESSION['dbpwd'], $_SESSION['dbname']);
$sql = "SELECT * FROM members WHERE email = '" . $email . "'";
$rtn = $con->query($sql);

if (mysqli_num_rows($rtn) > 0) {
   $result = $rtn->fetch_assoc();
} else {
   echo "<br><br><center><font color='red'>Record Not Found<br><br><font color='tan'>Click Back Button - Try Again<br><br>";
}
$con -> close();

?>

<form action="ndmasave.php" method="POST">
<br>
<label class="label" for="email">eMail Address:</label><br>
<input class="input" type="email" id="email" name="email" maxlength="40" size="41" value="<?php echo $result['email']; ?>">
<br><br>
<label class="label" for="pwd">Password:</label><br>
<input class="input "type="text" id="pwd" name="pwd" maxlength="10" size="12" value="<?php echo $result['pwd']; ?>">
<br><br>
<label class="label" for="phn">Telephone:</label><br>
<input class="input" type="text" id="phn" name="phn" maxlength="16" size="17" value="<?php echo $result['phone']; ?>">
<br><br>
<label class="label" for="join">Join Date:</label><br>
<input class="input" type="date" id="join" name="join" maxlength="10" size="11" value="<?php echo $result['jdate']; ?>">
<br><br>
<label class="label" for="cntry">Country:</label><br>
<input class="input" type="text" id="cntry" name="cntry" maxlength="20" size="21" value="<?php echo $result['country']; ?>">
<br><br>
<!---<label class="label" for="refby">Referrer Code:</label><br>
<input class="input "type="text" id="refby" name="refby" maxlength="10" size="12" value="<?php echo $result['refby']; ?>">
<br><br>
<label class="label" for="rcode">Referral Code:</label><br>
<input class="input "type="text" id="rcode" name="rcode" maxlength="10" size="12" value="<?php echo $result['refcode']; ?>" readonly>
<br><br>
<label class="label" for="commp">Commissions Pending:</label><br>
<input class="input "type="text" id="commp" name="commp" maxlength="7" size="8" value="<?php echo $result['commpend']; ?>" style="text-align: right;">
<br><br>
<label class="label" for="commt">Referral Code:</label><br>
<input class="input "type="text" id="commt" name="commt" maxlength="7" size="8" value="<?php echo $result['commtot']; ?>" style="text-align: right;">
<br><br>--->
<label class="label" for="act">Active?</label><br>
<input class="input" type="checkbox" id="act" name="act" <?php echo $result['act'] == 1 ? 'checked="checked"' : '';?>>
<br><br>
<label class="label" for="vend">Vendor?</label><br>
<input class="input" type="checkbox" id="vend" name="vend" <?php echo $result['vend'] == 1 ? 'checked="checked"' : '';?>>
<br><br>
<label class="label" for="tier">Tier</label><br>
<select class="input" id="tier" name="tier">
<option class="input" value="0"<?php if($result['tier'] == '0'){ echo 'selected'; } ?>>Free</option>
<option class="input" value="1"<?php if($result['tier'] == '1'){ echo 'selected'; } ?>>Starter</option>
<option class="input" value="2"<?php if($result['tier'] == '2'){ echo 'selected'; } ?>>Trader</option>
<option class="input" value="3"<?php if($result['tier'] == '3'){ echo 'selected'; } ?>>Pro Trader</option>
<option class="input" value="4"<?php if($result['tier'] == '4'){ echo 'selected'; } ?>>Tycoon</option>
<option class="input" value="5"<?php if($result['tier'] == '5'){ echo 'selected'; } ?>>Tycoon Plus</option>
</select>
<br><br>
<label class="label" for="usdt">USDT Required for Tier:</label><br>
<input class="input" type="text" id="usdt" name="usdt" maxlength="4" size="5" style="text-align: right;" value ="<?php echo $result['usdt']; ?>">
<br><br>
<label class="label" for="usdt">USDT Actually Paid:</label><br>
<input class="input" type="text" id="usdta" name="usdta" maxlength="4" size="5" style="text-align: right;" value ="<?php echo $result['usdta']; ?>">
<br><br>
<label class="label" for="hash">USDT tx Hash:</label><br>
<textarea class="textarea" id="hash" name="hash" rows="2" cols="40" maxlength="60"><?php echo $result['txhash']; ?></textarea>
<br><br>
<label class="label" for="radd">USDT Receive Address</label><br>
<textarea class="textarea" id="radd" name="radd" rows="2" cols="40" maxlength="60"><?php echo $result['usdtadd']; ?></textarea>
<br><br>
<label class="label" for="edate">Exchange Date:</label><br>
<input class="input" type="date" id="edate" name="edate" maxlength="10" size="11" value="<?php echo $result['edate']; ?>">
<br><br>
<label class="label" for="erate">USDT Exchange Rate:</label><br>
<input class="input" type="text" id="erate" name="erate" maxlength="17" size="18" style="text-align:right;" value="<?php echo $result['erate']; ?>">
<br><br>
<label class="label" for="epic">Epic Balance:</label><br>
<input class="input" type="text" id="epic" name="epic" maxlength="17" size="18" style="text-align:right;" value="<?php echo $result['epic']; ?>">
<br><br>
<button class="button"><font face="arial">Save Edits</font>
</button>
</form>
<form action="ndmalogin.php" method="POST">
<button class="button" name="erec">Home</button>
</form>
<img src="NowDealsLogo.png" alt="NowDeals" style="width:107px;height:57px;">
</body>
</html>


