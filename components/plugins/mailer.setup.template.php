<?php
$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->Timeout = 120;
$mail->SMTPSecure = "SSL"; // secure transfer enabled REQUIRED for GMail
$mail->Host = "smtpout.secureserver.net";
$mail->Port = "25"; // or 587
$mail->IsHTML(true);
$mail->Username = "support@mobilyser.net";
$mail->Password = "support2014";
$mail->SetFrom("support@mobilyser.net");

?>