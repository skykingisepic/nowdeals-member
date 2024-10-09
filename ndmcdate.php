<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!---<html xmlns="http://www.w3.org/1999/xhtml">--->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="NowDeals Update Commissions">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
<title>NowDeals Update Commissions</title>
<link rel="stylesheet" href="styles.css">
</head>

<body>
<center>
<p class="bigtext"><strong>NowDeals<br>Update Commissions</strong></p>

<!---<p>Enter Date Range for Update Commissions</p>
<p>Leave Blank for Other Tasks</p>--->
<form method="POST">
<!---<br>
<label class="label" for="sdate">Start Date:</label>
<input class="input" type="date" id="sdate" name="sdate" size="11" maxlength="10">
<br><br>
<label class="label" for="edate">End Date:</label>
<input class="input" type="date" id="edate" name="edate" size="11" maxlength="10">
<br><br>
<button class="button" name="upd">Update Commissions</button>
<br>
<button class="button" name="rpt">Pending Report</button>
<br>--->
<button class="button" name="rmdr">eMail Reminders No Rcv Add</button>
<br>
<button class="button" name="pay">MLM Commission Payouts</button>
<br>
<button class="button" name="req">USDT Required For Payouts</button>
<br>
<button class="button" name="home">Home</button>
</form>
<img src="NowDealsLogo.png" alt="NowDeals" style="width:107px;height:57px;">
</body>
</html>

<?php

//if (array_key_exists('upd',$_POST)){
//$_SESSION['sdate'] = $_POST['sdate'];
//$_SESSION['edate'] = $_POST['edate'];
//header("Location: ndmcomm.php");
//}
//if (array_key_exists('rpt',$_POST)){
//header("Location: ndmcommlist.php");
//}
if (array_key_exists('rmdr',$_POST)){
header("Location: ndmcsend.php");
}
if (array_key_exists('req',$_POST)){
header("Location: ndmcommreq.php");
}
if (array_key_exists('pay',$_POST)){
//header("Location: ndmcpend.php");
header("Location: ndmpaymlm.php");
}
if (array_key_exists('home',$_POST)){
header("Location: ndmalogin.php");
}
?>



