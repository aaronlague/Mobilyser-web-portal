<?php
class EmailModel {

	public function signupMail($email, $mobile){

		$to  = $email;

		// subject
		$subject = 'Registration Confirmation Email';

		// message
		$message = 'test';

		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		// Additional headers
		$headers .= 'From: Mobilyser <admin@mobilyser.co>' . "\r\n";

		// Mail it
		mail($to, $subject, $message, $headers)or die("Doesn't work");
		
	}

}
?>