<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!---<html xmlns="http://www.w3.org/1999/xhtml">--->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="NowDeals Send Epic eMails">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
<title>NowDeals Send Epic eMails</title>
<link rel="stylesheet" href="styles.css">
</head>

<body>
<center>
<p class="bigtext"><strong>NowDeals<br>Send Epic eMails</strong></p>

<p>Enter Date Range for New Member Join</p>
<form method="POST">
<br>
<label class="label" for="sdate">Start Date:</label>
<input class="input" type="date" id="sdate" name="sdate" size="11" maxlength="10">
<br><br>
<label class="label" for="edate">End Date:</label>
<input class="input" type="date" id="edate" name="edate" size="11" maxlength="10">
<br><br>
<button class="button" name="send">Send eMails</button>
</form>
<br><br><br>
<img src="NowDealsLogo.png" alt="NowDeals" style="width:107px;height:57px;">
</body>
</html>

<?php
if (array_key_exists('send',$_POST)){
$_SESSION['sdate'] = $_POST['sdate'];
$_SESSION['edate'] = $_POST['edate'];
header("Location: ndmesend.php");
}
?>



