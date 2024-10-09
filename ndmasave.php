<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!---<html xmlns="http://www.w3.org/1999/xhtml">--->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="NowDeals Save Member Record">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
<title>NowDeals Save Member Record</title>
<link rel="stylesheet" href="styles.css">
</head>

<body>
<center>
<p class="bigtext"><strong>NowDeals<br>Save Member Record</strong></p>

<?php

$email = $_POST['email'];
$pwd = $_POST['pwd'];
$phn = $_POST['phn'];
$join = $_POST['join'];
$tier = $_POST['tier'];
$hash = $_POST['hash'];
if ($_POST['edate'] == '') { $edate = $join; } else { $edate = $_POST['edate']; }
$erate = $_POST['erate'];
$epic = $_POST['epic'];
$usdt = $_POST['usdt'];
$usdta = $_POST['usdta'];
$cntry = $_POST['cntry'];
//$refby = $_POST['refby'];
$radd = $_POST['radd'];
//$commp = $_POST['commp'];
//$commt = $_POST['commt'];

if (isset($_POST['act'])) { $act = 1; } else { $act = 0; }
if (isset($_POST['vend'])) { $vend = 1; } else { $vend = 0; }

$con = new mysqli($_SESSION['dbhost'], $_SESSION['dbuser'], $_SESSION['dbpwd'], $_SESSION['dbname']);
$sql = "UPDATE members SET email = '" . $email . "', phone = '" . $phn . "', pwd = '" . $pwd;
$sql .= "', jdate = '" . $join . "', tier = '" . $tier . "', txhash = '" . $hash;
$sql .= "', edate = '" . $edate . "', erate = " . $erate . ", epic = " . $epic;
$sql .= ", usdt = " . $usdt . ", act = " . $act . ", country = '" . $cntry;
$sql .= "', txhash = '" . $hash . "', usdtadd = '" . $radd . "', vend = " . $vend;
$sql .= " WHERE email = '" . $_SESSION['memail'] . "'";
//echo '<script>alert("'.$sql.'");</script>';
$con->query($sql);
$con -> close();
echo '<p><font size ="5" color="white">Member Record Saved</font></p><br><br>';

?>
<br>
<form action="ndmasrch.php" method="POST">
<button class="button" name="erec">Edit Another Record</button>
</form>
<br>
<form action="ndmembadd.php" method="POST">
<button class="button" name="arec">Add New Record</button>
</form>
<br>
<form action="ndmalogin.php" method="POST">
<button class="button" name="hrec">Home</button>
</form>
<img src="NowDealsLogo.png" alt="NowDeals" style="width:107px;height:57px;">
</body>
</html>

