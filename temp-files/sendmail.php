<?php
$to      = 'aaron.lague@flexisourceit.com.au';
$subject = 'hey You';
$message = 'Can you identify me :P';
$headers = 'From: aaronlague@yahoo.com' . "\r\n" .
    'Reply-To: aaronlague@yahoo.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
?>