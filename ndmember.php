<?php
require 'ndconf.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!---<html xmlns="http://www.w3.org/1999/xhtml">--->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="NowDeals Member Portal">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
<title>NowDeals Member Portal</title>
<link rel="icon" type="image/x-icon" href="favicon.png">
<link rel="stylesheet" href="styles.css">
</head>
<body>

<center>
<p class="bigtext"><strong>NowDeals<br>Member Portal</strong></p>

<table>
<form action="ndmembnew.php" method="POST"><tr><td><center>
<button class="button" name="arec">Register</button></td></tr>
</form>
<br>
<form action="ndmsrch.php" method="POST"><tr><td><center>
<button class="button" name="srec">View/Edit Record</button></td></tr>
</form>
</table>
<img src="NowDealsLogo.png" alt="NowDeals" style="width:107px;height:57px;">
</body>
</html>

