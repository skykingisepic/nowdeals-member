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
<p class="bigtext"><strong>NowDeals<br>Member Edit</strong></p>
<?php

$email = $_SESSION['memail'];
$pwd = $_SESSION['mpwd'];

$con = new mysqli($_SESSION['dbhost'], $_SESSION['dbuser'], $_SESSION['dbpwd'], $_SESSION['dbname']);
$sql = "SELECT * FROM members WHERE (email = '".$email."' AND pwd = '".$pwd."')";
$rtn = $con->query($sql);

if (mysqli_num_rows($rtn) > 0) {
   $result = $rtn->fetch_assoc();
} else {
   echo "<br><br><center><font color='red'>Record Not Found<br><br><font color='tan'>Click Back Button - Try Again<br><br>";
}
$con -> close();
?>

<form action="ndmesave.php" method="POST">
<br>
<label class="label" for="email">eMail Address:</label><br>
<input class="input" type="email" id="email" name="email" maxlength="40" size="41" value="<?php echo $result['email']; ?>" readonly>
<br><br>
<label class="label" for="pwd">Password:</label><br>
<input class="input" type="text" id="pwd" name="pwd" maxlength="10" size="12" value="<?php echo $result['pwd']; ?>">
<br><br>
<label class="label" for="phn">Telephone:</label><br>
<input class="input" type="text" id="phn" name="phn" maxlength="16" size="17" value="<?php echo $result['phone']; ?>">
<br><br>
<label class="label" for="cntry">Country:</label><br>
<input class="input" type="text" id="cntry" name="cntry" maxlength="20" size="21" value="<?php echo $result['country']; ?>">
<br><br>
<label class="label" for="vend">Vendor?</label><br>
<input class="input" type="checkbox" id="vend" name="vend">
<br><br>
<label class="label" for="radd">USDT Receive Address</label><br>
<textarea class="textarea" id="radd" name="radd" rows="2" cols="40" maxlength="60"><?php echo $result['usdtadd']; ?>"</textarea>
<br><br>
<button class="button">Save Edits</button>
</form>
<br>
<form action="ndmember.php" method="POST">
<button class="button">Cancel</button>
</form>
<img src="NowDealsLogo.png" alt="NowDeals" style="width:107px;height:57px;">
</body>
</html>

