<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!---<html xmlns="http://www.w3.org/1999/xhtml">--->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="NowDeals Uploaded File">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
<title>NowDeals Uploaded File</title>
<link rel="stylesheet" href="styles.css">
</head>

<body>
<center>
<p class="bigtext"><strong>NowDeals<br>Uploaded File</strong></p>

<?php
$target_dir = "/var/www/html/uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
//echo '<p><font color="white">'.$target_file;

// Check if file already exists
if (file_exists($target_file)) {
  unlink($target_file);
  //$uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo '<p><font color="white">File > 5Mb - Contact Admin';
  $uploadOk = 0;
}

// Allow certain file formats
if($FileType !== "csv") {
  echo '<p><font color="white">Sorry, only csv files are allowed.';
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo '<p><font color="white">File was not uploaded.';
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo '<p><font color="white">' .htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). ' has been uploaded.';
  } else {
    echo '<p><font color="white">Sorry, there was an error uploading your file.';
  }
}
?>
<form action="ndmalogin.php" method="POST">
<br><br>
<button class="button" name="home">Home</button>
</form>
<br>
<img src="NowDealsLogo.png" alt="NowDeals">
</body>
</html>



