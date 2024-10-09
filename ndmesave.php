<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!---<html xmlns="http://www.w3.org/1999/xhtml">--->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="NowDeals Edit Member">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
<title>NowDeals Edit Member</title>
<link rel="stylesheet" href="styles.css">
</head>

<body>
<center>
<p class="bigtext"><strong>NowDeals<br>Edit Member</strong></p>

<?php

$pwd = $_POST['pwd'];
$phn = $_POST['phn'];
$cntry = $_POST['cntry'];
$phn = $_POST['phn'];
if (isset($_POST['vend'])) { $vend = 1; } else { $vend = 0; }
$_SESSION['mpwd'] = $pwd;

$con = new mysqli($_SESSION['dbhost'], $_SESSION['dbuser'], $_SESSION['dbpwd'], $_SESSION['dbname']);
$sql = "UPDATE members SET phone = '" . $phn . "', pwd = '" . $pwd . "', ";
$sql .= "country = '" . $cntry . "', usdtadd = '" . $radd . "', vend = " . $vend;
$sql .= " WHERE email = '" . $_SESSION['memail'] . "'";
//echo '<script>alert("'.$sql.'");</script>';
$con->query($sql);
$con -> close();
echo '<p><font face="arial" size="5" color="white">Member Record Updated</font></p><br><br>';
?>
<br>
<form action="ndmember.php" method="POST">
<button class="button" name="erec">Home</button>
</form>
<img src="NowDealsLogo.png" alt="NowDeals" style="width:107px;height:57px;">
</body>
</html>

