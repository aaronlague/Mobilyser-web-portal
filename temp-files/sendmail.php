<?php
require("../components/plugins/class.phpmailer.php");
require("../components/plugins/class.smtp.php");
require("../components/plugins/PHPMailerAutoload.php");
$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = "TLS"; // secure transfer enabled REQUIRED for GMail
$mail->Host = "mail.flexisourceit.com.au";
$mail->Port = "587"; // or 587
$mail->IsHTML(true);
$mail->Username = "aaron.lague@flexisourceit.com.au";
$mail->Password = "Welcome01";
$mail->SetFrom("aaron.lague@flexisourceit.com.au");
$mail->Subject = "Test";
$mail->Body = "hello";
$mail->AddAddress("aaronlague@yahoo.com");
 if(!$mail->Send())
    {
    echo "Mailer Error: " . $mail->ErrorInfo;
    }
    else
    {
    echo "Message has been sent";
    }
?>
