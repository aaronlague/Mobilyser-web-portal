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
$indexController = new IndexController();
$lookupmodel = new LookupModel();

$connect = $db->connect();

$activationcodeURL = '';

$emailFlag['class'] = '';
$pwordFlag['class'] = '';

if(isset($_POST['btn-login'])){

    $email = $db->escape($_POST['email']);
    $password = $db->escape($_POST['password']);
    
    $emailFlag = $validationlib->isEmail($email, 'Email ', 3, 'n');
    $pwordFlag = $validationlib->isEmpty($password, '', 1);
    if($emailFlag['message'] == "" and $pwordFlag['message'] == ""){
      $indexController->indexPage($email, $password, $activationcodeURL, $connect);
    }
}

$fnameFlag['class'] = '';
$lnameFlag['class'] = '';
$emailaddressFlag['class'] = '';

if(isset($_POST['btn-signup'])){
	
    $fnameFlag = $validationlib->isEmpty($_POST['firstname'], 'First name', 2);
    $lnameFlag = $validationlib->isEmpty($_POST['lastname'], 'Last name', 2);
    $emailaddressFlag = $validationlib->isEmail($_POST['emailaddress'], 'Email', 5, 'y');
	
	$fname = $_POST['firstname'];
	$lname = $_POST['lastname'];
	$emailaddress = $_POST['emailaddress'];

    if($fnameFlag['message'] == "" and $lnameFlag['message'] == "" and $emailaddressFlag['message'] == ""){

		$data['@firstname'] = $_POST['firstname'];
		$data['@lastname'] = $_POST['lastname'];
		$data['@email'] = $_POST['emailaddress'];
		$data['@username'] = $_POST['emailaddress'];
		$data['@country'] = $_POST['country'];
		$data['@activation_key'] = mt_rand(0, 5000);
		$data['@token'] = sha1(uniqid($emailaddress, true));
		$data['@time_token'] = $_SERVER['REQUEST_TIME']; 
		$db->mquery_insert("dbo.createAccount", $data, $connect);
		
	 	$url = $indexController->createConfirmationLink($_POST['emailaddress'], $connect);
		
		$mail->Subject = "Mobilyser Email confirmation";
		$mail->Body = "Dear " . $fname . ' ' . $lname . "," . $bodyTextHead . $url . $bodyTextFooter;
		$mail->AddAddress($emailaddress);
		
		if ($mail->send()) {
			
			header("Location: confirmation.php");
			
		} else {
			
			//echo "Mailer Error: " . $mail->ErrorInfo;
			
		}
		
    }
}

$country_data = $lookupmodel->getCountry($connect);

?>
<?php include 'components/header.php'; ?>
<div class="section formHeadLine" data-page-name="signupPage">
<div class="container">
	<div class="row">
    <div>
      <h3>Create your account</h3>
	</div>
  </div>
</div>
</div>
<div class="container">
<div class="row">
    <div class="signUpSections col-lg-10 col-lg-offset-1">
      <h4>Personal details</h4>
      <p>To start the registration process please provide some basic personal information so that we can verify your identity and create your account. You can update your contact details within your profile.</p>
	  <div class="row">
	  	<div class="noteTxt">
			<span><strong>Mandatory field</strong></span><sup><i class="fa fa-asterisk"></i></sup>
		</div>
	  </div>
      <?php echo $formelem->create(array('method'=>'post','class'=>'signUpFormSection form-horizontal')); ?>
      <fieldset>
        <!-- Text input-->
        <div class="form-group <?php echo $fnameFlag['class'] ?>">
          <?php	echo $fnameFlag['message']; ?>
          <div class="col-md-12"> 
            <?php echo $formelem->text(array('id'=>'firstname','name'=>'firstname','placeholder'=>'First name*','class'=>'form-control input-md '.$fnameFlag['class'].'', 'value'=>$fname)); ?>
          </div>
        </div>
        <!-- Text input-->
        <div class="form-group <?php echo $lnameFlag['class'] ?>">
          <?php	echo $lnameFlag['message']; ?>
          <div class="col-md-12">
		  <?php echo $formelem->text(array('id'=>'lastname','name'=>'lastname','placeholder'=>'Last name*','class'=>'form-control input-md '.$lnameFlag['class'].'', 'value'=>$lname)); ?></div>
        </div>
        <!-- Text input-->
        <div class="form-group <?php echo $emailaddressFlag['class'] ?> ">
		  <?php echo $emailaddressFlag['message']; ?>
          <div class="col-md-12">
		  <?php echo $formelem->text(array('id'=>'emailaddress','name'=>'emailaddress','placeholder'=>'Email*','class'=>'form-control input-md '.$emailaddressFlag['class'].'', 'value'=>$email)); ?></div>
        </div>
        <!-- Select Basic -->
        <div class="form-group">
          <div class="col-md-12"> <?php echo $formelem->select(array('id'=>'country','name'=>'country','class'=>'form-control','data'=>$country_data)); ?></div>
        </div>
        <!-- Button -->
        <div class="form-group">
          <div class="col-md-4 col-md-push-5"> <?php echo $formelem->button(array('id'=>'btn-signup','name'=>'btn-signup','class'=>'btn btn-primary registerBtn', 'value'=>'Create account')); ?> </div>
        </div>
      </fieldset>
      <?php echo $formelem->close(); ?> </div>
  </div>
</div>
</div>
</div>
<!-- /.container -->
<script src="js/jquery-1.10.2.js"></script>
<script src="js/jquery.validate.js"></script>
<script src="js/core.js"></script>
<?php include 'components/footer.php'; ?>
