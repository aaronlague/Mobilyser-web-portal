<?php
session_start();

include 'protected/config/db_config.php';
include 'protected/config/html_config.php';
include 'protected/library/validation_library.php';
include 'protected/models/lookup.php';
include 'protected/models/email.php';
include 'protected/controllers/index.php';

$db = new db_config();
$formelem = new FormElem();
$validationlib = new validationLibrary();
$indexController = new IndexController();
$lookupmodel = new LookupModel();
$emailmodel = new EmailModel();

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
$mobileFlag['class'] = '';

if(isset($_POST['btn-signup'])){
	
    $fnameFlag = $validationlib->isEmpty($_POST['firstname'], 'First name', 2);
    $lnameFlag = $validationlib->isEmpty($_POST['lastname'], 'Last name', 2);
    $emailaddressFlag = $validationlib->isEmail($_POST['emailaddress'], 'Email', 5, 'y');
	  $acctNoFlag = $validationlib->isEmpty($_POST['accountNumber'], 'Account number', 5, 'y');
    $mobileFlag = $validationlib->isEmpty($_POST['mobileNumber'], 'Mobile number', 5);
	
	$fname = $_POST['firstname'];
	$lname = $_POST['lastname'];
	$emailaddress = $_POST['emailaddress'];
	$acctNo = $_POST['accountNumber'];
	$mobile = $_POST['mobileNumber'];

    if($fnameFlag['message'] == "" and $lnameFlag['message'] == "" and $emailaddressFlag['message'] == "" and $mobileFlag['message'] == "" ){

      $data['@password'] = '';
      $data['@firstname'] = $_POST['firstname'];
      $data['@lastname'] = $_POST['lastname'];
      $data['@email'] = $_POST['emailaddress'];
	    $data['@acct_no'] = $_POST['accountNumber'];
      $data['@mobilephone'] = $_POST['mobileNumber'];
	    $data['@country'] = $_POST['country'];
	    $data['@company'] = '';
	    $data['@telecom'] = '';
      
      $db->mquery_insert("dbo.createAccount", $data, $connect);
	    //$emailmodel->signupMail($db->escape($_POST['email']), $db->escape($_POST['mobileNumber']));
	  
      header("Location: confirmation.php");

    }

}

$country_data = $lookupmodel->getCountry($connect);
$telco = $lookupmodel->getTelecoms($connect);

$plantype_data = array(
  '1'=>'Plan A',
  '2'=>'Plan B',
  '3'=>'Plan C'
);
?>
<?php include 'components/header.php'; ?>

<div class="section formHeadLine">
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
          <div class="col-md-12"> <?php echo $formelem->text(array('id'=>'firstname','name'=>'firstname','placeholder'=>'First name*','class'=>'form-control input-md '.$fnameFlag['class'].'', 'value'=>$fname)); ?></div>
        </div>
        <!-- Text input-->
        <div class="form-group <?php echo $lnameFlag['class'] ?>">
          <?php	echo $lnameFlag['message']; ?>
          <div class="col-md-12"> <?php echo $formelem->text(array('id'=>'lastname','name'=>'lastname','placeholder'=>'Last name*','class'=>'form-control input-md '.$lnameFlag['class'].'', 'value'=>$lname)); ?></div>
        </div>
        <!-- Text input-->
        <div class="form-group <?php echo $emailaddressFlag['class'] ?> ">
		  <?php echo $emailaddressFlag['message']; ?>
          <div class="col-md-12"> <?php echo $formelem->text(array('id'=>'emailaddress','name'=>'emailaddress','placeholder'=>'Email*','class'=>'form-control input-md '.$emailaddressFlag['class'].'', 'value'=>$email)); ?></div>
        </div>
        <!-- Text input-->
        <div class="form-group <?php echo $acctNoFlag['class'] ?>"> <?php echo $acctNoFlag['message']; ?>
          <div class="col-md-12"> <?php echo $formelem->text(array('id'=>'accountNumber','name'=>'accountNumber','placeholder'=>'Account number*','class'=>'form-control input-md '.$acctNoFlag['class'].'', 'value'=>$acctNo));?></div>
        </div>
		<!-- Select Basic -->
        <div class="form-group">
          <div class="col-md-12"> <?php echo $formelem->select(array('id'=>'telco','name'=>'telco','class'=>'form-control','data'=>$telco)); ?></div>
        </div>
        <!-- Text input-->
        <div class="form-group <?php echo $mobileFlag['class']; ?>"> <?php echo $mobileFlag['message']; ?>
          <div class="col-md-12"> <?php echo $formelem->text(array('id'=>'mobileNumber','name'=>'mobileNumber','placeholder'=>'Mobile number*','class'=>'form-control input-md '.$mobileFlag['class'].'', 'value'=>$mobile)); ?></div>
        </div>
        <!-- Select Basic -->
        <div class="form-group">
          <div class="col-md-12"> <?php echo $formelem->select(array('id'=>'country','name'=>'country','class'=>'form-control','data'=>$country_data)); ?></div>
        </div>
        <hr / >
        <h4>Telecom Provider Information</h4>
        <p>Please provide some basic information about your telco plan. We use this information to calculate estimated costs for each call you make. You can provide this information later through your profile.<br />
          <br />
          Most telcos provide call cost information on their websites. Call costs vary between different mobile plans, with the same provider.</p>
        <!-- Text input-->
        <div class="form-group">
          <div class="col-md-12"> <?php echo $formelem->text(array('id'=>'connectionfee','name'=>'connectionfee','placeholder'=>'Connection fee','class'=>'form-control input-md')); ?> </div>
        </div>
        <!-- Text input-->
        <div class="form-group">
          <div class="col-md-12"> <?php echo $formelem->text(array('id'=>'callcharge','name'=>'callcharge','placeholder'=>'60 Second call charge','class'=>'form-control input-md')); ?> </div>
        </div>
        <div class="form-group">
          <div class="col-md-12"> <?php echo $formelem->text(array('id'=>'plancap','name'=>'plancap','placeholder'=>'Plan cap','class'=>'form-control input-md')); ?> </div>
        </div>
        <span class="note"><strong>Please note:</strong> Due to the complex billing arrangements most Telcos have in place for international calls we are unable to estimate the cost of these calls.</span>
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
<script src="js/field-validator.js"></script>
<script src="js/core.js"></script>
<?php include 'components/footer.php'; ?>
