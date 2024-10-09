<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!---<html xmlns="http://www.w3.org/1999/xhtml">--->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="NowDeals Member Input">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
<title>NowDeals Member Input</title>
<link rel="stylesheet" href="styles.css">
</head>

<body>
<center>
<p class="bigtext"><strong>NowDeals<br>Member Input</strong></p>
<?php

$login = $_SESSION['login'];
if (!isset($_SESSION['login'])) {
   $_SESSION['bp'] = 'y';
   header("Location: ndmalogin.php");
}
if ($login !== $_SESSION['admin']) {
   $_SESSION['bp'] = 'y';
   header("Location: ndmalogin.php");
}
function randpwd() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%*-+=';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 10; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
?>
<form action="ndmadd.php" method="POST">
<br>
<label class="label" for="email">eMail Address:</label><br>
<input class="input" type="email" id="email" name="email" maxlength="40" size="41" required>
<br><br>
<label class="label" for="pwd">Password:</label><br>
<input class="input" type="text" id="pwd" name="pwd" maxlength="10" size="12" value="<?php echo randpwd(); ?>" required>
<br><br>
<label class="label" for="phn">Telephone:</label><br>
<input class="input" type="text" id="phn" name="phn" maxlength="16" size="11">
<br><br>
<label class="label" for="jdate">Join Date:</label><br>
<input class="input" type="date" id="jdate" name="jdate" value=<?php echo date('Y-m-d');?> maxlength="10" size="11" required>
<br><br>
<label class="label" for="cntry">Country:</label><br>
<input class="input" type="text" id="cntry" name="cntry" maxlength="20" size="21" required>
<br><br>
<label class="label" for="vend">Vendor?</label><br>
<input class="input" type="checkbox" id="vend" name="vend">
<br><br>
<label class="label" for="usdt">USDT Required For Tier:</label><br>
<select id="usdt" name="usdt">
  <option value="0">Free</option>
  <option value="100">Starter</option>
  <option value="500">Trader</option>
  <option value="1000">Pro Trader</option>
  <option value="2500">Tycoon Trader</option>
  <option value="5000">Tycoon Plus Trader</option>
</select>
<!---<input class="input" type="text" id="usdt" name="usdt" maxlength="4" size="5" value = "0" style="text-align: right;" required>--->
<br><br>
<label class="label" for="usdt">USDT Actually Paid:</label><br>
<input class="input" type="text" id="usdta" name="usdta" maxlength="4" size="5" value = "0" style="text-align: right;" required>
<br><br>
<label class="label" for="hash">USDT tx Hash</label><br>
<textarea class="textarea" id="hash" name="hash" rows="2" cols="40" maxlength="60" required></textarea>
<br><br>
<button class="button">Add Member</button>
</form>
<br>
<form action="ndmalogin.php" method="POST">
<button class="button" name="srch">Home</button>
</form>

<img src="NowDealsLogo.png" alt="NowDeals" style="width:107px;height:57px;">
</body>
</html>

