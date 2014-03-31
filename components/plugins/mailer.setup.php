<?php
$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = "SSL"; // secure transfer enabled REQUIRED for GMail
$mail->Host = "smtpout.secureserver.net";
$mail->Port = "25"; // or 587
$mail->IsHTML(true);
$mail->Username = "support@mobilyser.net";
$mail->Password = "support2014";
$mail->SetFrom("support@mobilyser.net");

$bodyTextHead = "<br /><br />Welcome to Mobilyser. To get started simply click the button below within 24 hours of receiving this email to ensure your details remain secure.<br /><br />
		<b>Activation code</b><br /><br />";
		
$PasswordResetText = "<br /><br />Need to reset your password? Simply click the button below within 24 hours of receiving this email to ensure your details remain secure.<br /><br />
		<b>Reset password</b><br /><br />";

$PasswordResetNote = "<br /><br /><p>If you haven't successfully reset your password within 24 hours please click the http://mobilyser.net/forgotpassword.php link again.</p>";

$bodyTextFooter = "		
		<br /><br /><p>Please do not hesitate to contact us at support@mobilyser.net with any questions.</p>
		<p>The Team at Mobllyser</p><br /><br />
		
		<b><u>Why use Mobilyser?</u></b><br /><br />
		
		<b>Tax</b><br />
		
		<p>Call related data collected by Mobilyser 
		can be used at the end of the tax year to 
		support your tax return. Mobilyser reduces 
		your tax liability, whilst providing vital 
		evidence should your tax affairs be audited 
		by the Australian Tax Office.</p>
		
		<b>Expenses</b><br />
		
		<p>Mobilyser provides an accurate way of 
		capturing the exact amount you spend each 
		month on work related calls. You can use 
		this data to submit a valid expense claim to 
		your employer.</p>
		
		<b>Costs</b>
		
		<p>Many organisations struggle to keep 
		control of mobile service costs. Mobilyser 
		reduces these costs by more effectively 
		managing the cost of mobile phone plans.</p><br />
		 
		<p>Copyright © 2014 JKP Tech. All rights reserved.
		JKP Tech Pty Ltd ABN XXXXXXXX.</p>";

?>