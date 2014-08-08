<?php
$response = array();
include 'php_mailer/config.php'; // include the library file
include "php_mailer/class.phpmailer.php"; // include the class name
function sendmail($email) {
	if (smtpmailer($email, 'miyoteeapp@gmail.com', 'yourName', '[Miyotee]-test mail message', 'Hello World!')) {
		return 1;	
	}
	if (!empty($error)) return 0;
}

function smtpmailer($to, $from, $from_name, $subject, $body) { 
	global $error;
	$mail = new PHPMailer();  // create a new object
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true;  // authentication enabled
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 465; 
	$mail->Username = SMTP_UNAME;
	$mail->Password = SMTP_PWORD;
	$mail->SetFrom($from, $from_name);
	$mail->Subject = $subject;
	$mail->Body = $body;
	$mail->AddAddress($to);
	if(!$mail->Send()) {
		$error = 'Mail error: '.$mail->ErrorInfo; 
		return false;
	} else {
		$error = 'Message sent!';
		return true;
	}
}
?>
