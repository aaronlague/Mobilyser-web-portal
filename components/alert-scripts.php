<?php

if ($_GET['createpasswordsuccess'] =='true') {
	echo '<script>showAlertSuccess();</script>';
}

if ($_GET['resetpassword'] =='true') {
	echo '<script>showAlertSuccess();</script>';
}

if ($_GET['tokenexpired'] =='true' && $_GET['reset'] =='true') {

	echo '<script>tokenExpiryReset();</script>';

} else if ($_GET['tokenexpired'] =='true' && $_GET['reset'] =='false') {
	
	echo '<script>tokenExpiryCreate();</script>';
}

if ($_GET['invalidtoken'] =='true') {
	echo '<script>tokenInvalid();</script>';
}

if ($_GET['emailvalid'] == 'true'){

	echo '<script>passwordResetSuccess();</script>';

} else if ($_GET['emailvalid'] == 'false') {

	echo '<script>passwordResetFail();</script>';

}

if ($_GET['register_success'] == "true") {
	echo '<script>registerInterest();</script>';
}

if($_GET['signup_success'] == "true") {
	echo '<script>accountSignup();</script>';
}

?>