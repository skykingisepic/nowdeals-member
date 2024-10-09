<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//test
require '/mnt/ssd480/NowDeals/PHPMailer.php';
require '/mnt/ssd480/NowDeals/SMTP.php';
require '/mnt/ssd480/NowDeals/Exception.php';
//prod
//require '/var/www/html/members/PHPMailer.php';
//require '/var/www/html/members/SMTP.php';
//require '/var/www/html/members/Exception.php';

$mail = new PHPMailer(true);

//$mail->SMTPDebug = SMTP::DEBUG_SERVER;
$mail->isSMTP();
$mail->Host       = 'mail.nowdeals.com';
$mail->SMTPAuth   = true;
$mail->Username   = 'mailer@nowdeals.com';
$mail->Password   = 'R;vBY5BSgz';
//$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
//$mail->Port       = 465;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port       = 587;
$mail->setFrom('mailer@nowdeals.com', 'Mailer');
$mail->addReplyTo('info@nowdeals.com', 'No Reply');
$mail->isHTML(true);

?>

