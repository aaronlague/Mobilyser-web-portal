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
require("components/plugins/mailer.setup.template.php");

$db = new db_config();
$formelem = new FormElem();
$validationlib = new validationLibrary();
$lookupmodel = new LookupModel();
$indexController = new IndexController();

$connect = $db->connect();

$activationcodeURL = '';

$emailFlag['class'] = '';
$pwordFlag['class'] = '';

if(isset($_POST['btn-login'])){

    $email = $db->escape($_POST['email']);
    $password = $db->escape($_POST['password']);
    
    $emailFlag = $validationlib->isEmail($email, '', 3, 'n');
    $pwordFlag = $validationlib->isEmpty($password, '', 1);
    if($emailFlag['message'] == "" and $pwordFlag['message'] == ""){
      $indexController->indexPage($email, $password, $activationcodeURL, $connect);
    }

}

$fnameFlag['class'] = '';
$lnameFlag['class'] = '';
$emailFlag['class'] = '';

if(isset($_POST['btn-register'])){
    
    $fnameFlag = $validationlib->isEmpty($_POST['firstname'], 'First name', 2);
    $lnameFlag = $validationlib->isEmpty($_POST['lastname'], 'Last name', 2);
    $emailFlag = $validationlib->isEmail($_POST['email'], 'Email', 5, 'y');
	
	$fname = $_POST['firstname'];
	$lname = $_POST['lastname'];
	$email = $_POST['email'];

    if($fnameFlag['message'] == "" and $lnameFlag['message'] == "" and $emailFlag['message'] == ""){
	
		$data['@firstname'] = $_POST['firstname'];
		$data['@lastname'] = $_POST['lastname'];
		$data['@email'] = $_POST['email'];
		$indexController->registerInterest($data, $connect);
		
		ob_start();
		$email_val = $email;
		$firstname_val = $fname;
		$lastname_val = $lname;
		require 'view/htmlemail.php';
		$body = ob_get_contents();
		ob_end_clean();
		
		$mail->Subject = "Mobilyser Email confirmation";
		$mail->Body = $body;
		$mail->AddAddress($email);
		
		if ($mail->send()) {
			
			header("Location: confirmation?register_success=true");
			
		} else {
			
			//echo "Mailer Error: " . $mail->ErrorInfo;
			
		}

    }

}

?>
<?php include 'components/header.php'; ?>
<div class="section formHeadLine" data-page-name="registerYourInterestPage">
<div class="container">
	<div class="row">
    <div>
	<div id="errorMessages" class="errMsg"></div>
      <h3>Register your interest</h3>
	</div>
  </div>
</div>
</div>
<div class="registerContainer container">
  <div class="row">
    <div class="registerSections col-lg-10 col-lg-offset-1">
      <h4>Personal details</h4>
      <p>Mobilyser is still being developed, we expect the site to go-live around the end of the current tax year. To keep up-to-date with progress during the development phase please complete the form below.</p>
	  <div class="row">
	  	<div class="noteTxt">
			<span><strong>Mandatory field</strong></span><sup><i class="fa fa-asterisk"></i></sup>
		</div>
	  </div>
      <?php echo $formelem->create(array('method'=>'post','class'=>'form-horizontal regFormSection', 'id'=>'regFormSection')); ?>
      <fieldset>
        <!-- Text input-->
        <div class="form-group">
          <?php	echo $fnameFlag['message']; ?>
          <div class="col-md-12"> <?php echo $formelem->text(array('id'=>'firstname','name'=>'firstname','placeholder'=>'First name*','class'=>'form-control input-md '.$fnameFlag['class'].'', 'value'=>$fname)); ?></div>
        </div>
        <!-- Text input-->
        <div class="form-group">
		  <?php echo $lnameFlag['message']; ?>
          <div class="col-md-12"><?php echo $formelem->text(array('id'=>'lastname','name'=>'lastname','placeholder'=>'Last name*','class'=>'form-control input-md '.$lnameFlag['class'].'', 'value'=>$lname)); ?></div>
        </div>
        <!-- Text input-->
        <div class="form-group">
		  <?php echo $emailFlag['message']; ?>
          <div class="col-md-12"><?php echo $formelem->text(array('id'=>'email','name'=>'email','placeholder'=>'Email*','class'=>'form-control input-md '.$emailFlag['class'].'', 'value'=>$email)); ?></div>
        </div>
        <!-- Button -->
        <div class="submitContainer form-group">
          <div class="col-md-12"> <?php echo $formelem->button(array('id'=>'btn-register','name'=>'btn-register','class'=>'btn btn-primary registerBtn', 'value'=>'Register your interest')); ?> </div>
        </div>
      </fieldset>
      <?php echo $formelem->close(); ?>
	 </div>
  </div>
</div>
<!-- /.container -->
<script src="js/jquery-1.10.2.js"></script>
<script src="js/jquery.validate.js"></script>
<script src="js/core.js"></script>
<?php include 'components/footer.php'; ?>
