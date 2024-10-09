<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//prod
require '/var/www/html/members/PHPMailer.php';
require '/var/www/html/members/SMTP.php';
require '/var/www/html/members/Exception.php';

$mail = new PHPMailer(true);

//$mail->SMTPDebug = SMTP::DEBUG_SERVER;
$mail->isSMTP();
$mail->Host       = 'your.mailserver';
$mail->SMTPAuth   = true;
$mail->Username   = 'mailer@nowdeals.com';
$mail->Password   = 'password';
//$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
//$mail->Port       = 465;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port       = 587;
$mail->setFrom('mailer@nowdeals.com', 'Mailer');
$mail->addReplyTo('info@nowdeals.com', 'No Reply');
$mail->isHTML(true);

?>

