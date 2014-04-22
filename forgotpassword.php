<?php
session_start();

include 'protected/config/db_config.php';
include 'protected/config/html_config.php';
include 'protected/library/validation_library.php';
include 'protected/models/lookup.php';
include 'protected/controllers/index.php';

require("components/plugins/class.phpmailer.php");
require("components/plugins/class.smtp.php");
require("components/plugins/PHPMailerAutoload.php");
require("components/plugins/mailer.setup.php");

$db = new db_config();
$formelem = new FormElem();
$validationlib = new validationLibrary();
$lookupmodel = new LookupModel();
$indexController = new IndexController();

$connect = $db->connect();

$email = '';

include 'protected/config/login_config.php';

if(isset($_POST['btn-sendPass'])){

	$username = $_POST['email'];
	$url = $indexController->createForgotPasswordLink($username, $connect);
	
	if ($url == NULL) {
	
		header("Location: index.php?emailvalid=false");
	
	} else {
	
		$userInfo = $_SESSION['userinfo'];
		
		$mail->Subject = "Mobilyser password reset";
		$mail->Body = "Dear " .$userInfo. "," . $PasswordResetText . $url . $PasswordResetNote . $bodyTextFooter;
		$mail->AddAddress($username);
		
		if ($mail->send()) {
			
			header("Location: index.php?emailvalid=true");
			
		} else {
			
			//echo "Mailer Error: " . $mail->ErrorInfo;
		}
	
	}
}

$country_data = $lookupmodel->getCountry($connect);

?>
<?php include 'components/header.php'; ?>
<div class="section formHeadLine" data-page-name="forgotPasswordPage">
<div class="container">
	<div class="row">
    <div class="col-lg-10 col-lg-offset-1">
	  <?php include 'components/modal-alerts.php'; ?>
      <h3>Forgot your password?</h3>
	</div>
  </div>
</div>
</div>
<div class="forgotPasswordContainer container">
  <div class="row">
    <div class="forgotPasswordSection col-lg-10 col-lg-offset-1">
	<p>Please enter your email address below. You will receive an email with further instructions on resetting your password. </p>
	<?php echo $formelem->create(array('method'=>'post','class'=>'form-horizontal forgotPasswordFormSection', 'id'=>'forgotPasswordFormSection')); ?>
	<div id="errorMessages" class="errMsg"><ul></ul></div>
      <fieldset>
        <!-- Text input-->
        <div class="form-group">	
          <div class="col-md-12"><?php echo $formelem->text(array('id'=>'email','name'=>'email','placeholder'=>'Email','class'=>'form-control input-md '.$emailFlag['class'].'')); ?></div>
        </div>
		<!-- Button -->
        <div class="submitContainer form-group">
          <div class="col-md-12"> <?php echo $formelem->button(array('id'=>'btn-sendPass','name'=>'btn-sendPass','class'=>'btn btn-primary registerBtn', 'value'=>'Submit')); ?> </div>
        </div>
      </fieldset>
      <?php echo $formelem->close(); ?> </div>
  </div>
</div>
<!-- /.container -->
<script src="js/jquery-1.10.2.js"></script>
<script src="js/modal-actions.js"></script>
<script src="js/jquery.validate.js"></script>
<script src="js/core.js"></script>
<?php include 'components/footer.php'; ?>