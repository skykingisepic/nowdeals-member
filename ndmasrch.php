<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!---<html xmlns="http://www.w3.org/1999/xhtml">--->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="NowDeals Admin Member Search">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
<title>NowDeals Admin Member Search</title>
<link rel="stylesheet" href="styles.css">
</head>

<body>
<center>
<p class="bigtext"><strong>NowDeals Admin<br>Member Search</strong></p>

<form method="POST">
<br>
<label class="label" for="email">eMail Address:</label>
<input class="input" type="email" id="email" name="email" maxlength="40" size="41">
<br><br>
<button class="button" name="disp">View Member</button>
<br><br>
<button class="button" name="edit">Edit Member</button>
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

if (array_key_exists('edit',$_POST)){
  $_SESSION['memail'] = $_POST['email'];
  header("Location: ndmaedit.php");
}
if (array_key_exists('disp',$_POST)){
  $_SESSION['memail'] = $_POST['email'];
  header("Location: ndmainfo.php");
}
?>



