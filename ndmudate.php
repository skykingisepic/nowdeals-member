<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!---<html xmlns="http://www.w3.org/1999/xhtml">--->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="NowDeals Get USDT">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
<title>NowDeals Get USDT</title>
<link rel="stylesheet" href="styles.css">
</head>

<body>
<center>
<p class="bigtext"><strong>NowDeals<br>Get USDT</strong></p>

<p>Enter Date Range for USDT Total</p>
<form method="POST">
<br>
<label class="label" for="sdate">Start Date:</label>
<input class="input" type="date" id="sdate" name="sdate" size="11" maxlength="10">
<br><br>
<label class="label" for="edate">End Date:</label>
<input class="input" type="date" id="edate" name="edate" size="11" maxlength="10">
<br><br>
<button class="button" name="send">Get USDT Tot</button>
<br><br>
<button class="button" name="verif">Verify USDT</button>
</form>
<br>
<form action="ndmalogin.php" method="POST">
<button class="button" name="erec">Home</button>
</form>
<br><br><br>
<img src="NowDealsLogo.png" alt="NowDeals" style="width:107px;height:57px;">
</body>
</html>

<?php
if (array_key_exists('send',$_POST)){
$_SESSION['sdate'] = $_POST['sdate'];
$_SESSION['edate'] = $_POST['edate'];
header("Location: ndmusdt.php");
if (array_key_exists('verif',$_POST)){
$_SESSION['sdate'] = $_POST['sdate'];
$_SESSION['edate'] = $_POST['edate'];
header("Location: ndmusdtverif.php");
}
?>



