<?php
session_start();
require 'ndconf.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!---<html xmlns="http://www.w3.org/1999/xhtml">--->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="NowDeals Admin Portal">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
<title>NowDeals Admin Portal</title>
<link rel="icon" type="image/x-icon" href="favicon.png">
<link rel="stylesheet" href="styles.css">
</head>

<body>
<center>
<p class="bigtext"><strong>NowDeals<br>Admin Portal</strong></p>


<br>
<?php

if (isset($_SESSION['bp'])) {
   if ($_SESSION['bp'] == 'y') {
      unset($_SESSION['login']);
      $_SESSION['bp'] = "n";
      echo '<br><font color=Red face="arial" size="5">Bad Password - Try Again<br><br>';
   }
}

if (!isset($_SESSION['login'])) {
   echo '<form method="POST"><p><label for="login">Password:</label></p>
<input class= "input" type="text" id="login" name="login" size="11" maxlength="10">
<br><br>
<button class="button" name="log">Admin Login</button>
</form>
<br><br>';
}

if (array_key_exists('log',$_POST)){
   $_SESSION['login'] = $_POST['login'];
   $_SESSION['bp'] = 'n';
   if ($_POST['login'] !== $_SESSION['admin']) {
      $_SESSION['bp'] = 'y';
      Header('Location: '.$_SERVER['PHP_SELF']);
      //header("Refresh:0");
   }
   Header('Location: '.$_SERVER['PHP_SELF']);  
}
if (isset($_SESSION['login'])) {
   if ($_SESSION['bp'] == 'n') {
      echo '<table><form action="ndmasrch.php" method="POST"><tr><td><center>
<button class="button" name="srec">View Record</button></td>
</form>

</form><form action="ndmasrch.php" method="POST"><td><center>
<button class="button" name="srec">Edit Record</button></td></tr>
</form>

<form action="ndmembadd.php" method="POST"><tr><td><center>
<button class="button" name="arec">New Record</button></td>
</form>

<form action="ndmedate.php" method="POST"><td><center>
<button class="button" name="erec">Epic eMails</button></td></tr>
</form>

<form action="ndmudate.php" method="POST"><tr><td><center>
<button class="button" name="erec">Get USDT</button></td>
</form>

<form action="ndmepdate.php" method="POST"><td><center>
<button class="button" name="erec">Set Epic</button></td></tr>
</form>

<form action="ndmhdate.php" method="POST"><tr><td><center>
<button class="button" name="erec">Get txHashes</button></td>
</form>

<form action="ndmldate.php" method="POST"><td><center>
<button class="button" name="erec">Get MembList</button></td></tr>
</form>

<form action="ndmcdate.php" method="POST"><tr><td><center>
<button class="button" name="ucomm">Commissions</button></td>
</form>

<form action="ndmembmlm.php" method="POST"><td><center>
<button class="button" name="ucomm">Import Member</button></td></tr>
</form>

<form action="getupfile.php" method="POST"><tr><td><center>
<button class="button" name="upl">Upload File</button></td>
</form>

<form action="ndmverifusdt.php" method="POST"><td><center>
<button class="button" name="upl">Verify USDT</button></td></tr>
</form>

<form action="logout.php" method="POST"><tr><td colspan="2"><center>
<button class="button" name="logout">Logout</button></td></tr>
</form></table>';
   }
}
?>
<br>
<img src="NowDealsLogo.png" alt="NowDeals">
</body>
</html>

