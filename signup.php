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
$emailFlag['class'] = '';
$mobileFlag['class'] = '';

if(isset($_POST['btn-signup'])){
	
    $fnameFlag = $validationlib->isEmpty($_POST['firstname'], '', 2);
    $lnameFlag = $validationlib->isEmpty($_POST['lastname'], '', 2);
    $emailFlag = $validationlib->isEmail($_POST['email'], '', 5, 'y');
    $mobileFlag = $validationlib->isEmpty($_POST['mobileNumber'], '', 5);

    if($fnameFlag['message'] == "" and $lnameFlag['message'] == "" and $emailFlag['message'] == "" and $mobileFlag['message']){

      $data['@password'] = '';
      $data['@firstname'] = $_POST['firstname'];
      $data['@lastname'] = $_POST['lastname'];
      $data['@email'] = $_POST['email'];
      $data['@country'] = $_POST['country'];
      $data['@company'] = $_POST['companyname'];
      $data['@mobilephone'] = $_POST['mobileNumber'];
      $data['@acct_no'] = $_POST['accountNumber'];
      //$data['@telecom'] = $_POST['telco'];
      
      $db->mquery_insert("dbo.createAccount", $data, $connect);
	  $emailmodel->signupMail($db->escape($_POST['email']), $db->escape($_POST['mobileNumber']));
	  
      header("Location: confirmation.php");

    }

}

$country_data = $lookupmodel->getCountry($connect);

$plantype_data = array(
  '1'=>'Plan A',
  '2'=>'Plan B',
  '3'=>'Plan C'
);
?>
<?php include 'components/header.php'; ?>

<div class="container">
  <div class="row">
    <div class="col-lg-12" style="text-align:center;">
      <h2 class="">Create your account</h2>
      <sup><i class="fa fa-asterisk" style="color:red;"></i></sup> <span><strong> - Mandatory Field</strong></span></div>
  </div>
  <hr />
  <div class="row">
    <div class="col-lg-8 col-lg-push-2">
      <h3 style="text-align:center">Personal Details</h3>
      <p style="background-color: #ccc; padding: 15px; margin-bottom: 20px;">To start the registration process please provide some basic personal information so that we can verify your identity and create your account. You can update your contact details within your profile.</p>
      <?php echo $formelem->create(array('method'=>'post','class'=>'form-horizontal signUpFormSection')); ?>
      <fieldset>
        <!-- Text input-->
        <div class="form-group">
          <div class="col-md-12"> <?php echo $formelem->text(array('id'=>'firstname','name'=>'firstname','placeholder'=>'First name','class'=>'form-control input-md '.$fnameFlag['class'].'','required'=>'')); ?><span class="required">*</span></div>
        </div>
        <!-- Text input-->
        <div class="form-group">
          <div class="col-md-12"> <?php echo $formelem->text(array('id'=>'lastname','name'=>'lastname','placeholder'=>'Last name','class'=>'form-control input-md '.$lnameFlag['class'].'','required'=>'')); ?><span class="required">*</span></div>
        </div>
        <!-- Text input-->
        <div class="form-group">
          <div class="col-md-12"> <?php echo $formelem->text(array('id'=>'email','name'=>'email','placeholder'=>'Email','class'=>'form-control input-md '.$emailFlag['class'].'','required'=>'')); ?><span class="required">*</span></div>
        </div>
        <!-- Text input-->
        <div class="form-group">
          <div class="col-md-12"> <?php echo $formelem->text(array('id'=>'accountNumber','name'=>'accountNumber','placeholder'=>'Account number','class'=>'form-control input-md'));?><span class="required">*</span></div>
        </div>
        <!-- Text input-->
        <div class="form-group">
          <div class="col-md-12"> <?php echo $formelem->text(array('id'=>'mobileNumber','name'=>'mobileNumber','placeholder'=>'Mobile number','class'=>'form-control input-md '.$mobileFlag['class'].'','required'=>'')); ?><span class="required">*</span></div>
        </div>
        <!-- Select Basic -->
        <div class="form-group">
          <div class="col-md-12"> <?php echo $formelem->select(array('id'=>'country','name'=>'country','class'=>'form-control','data'=>$country_data)); ?><span class="required">*</span></div>
        </div>
        <hr / >
        <h3 style="text-align:center">Telecom Provider Information</h3>
        <p style="background-color: #ccc; padding: 15px; margin-bottom: 20px;">Please provide some basic information about your telco plan. We use this information to calculate estimated costs for each call you make. You can provide this information later through your profile.<br />
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
        <p><strong>Please note:</strong> Due to the complex billing arrangements most Telcos have in place for international calls we are unable to estimate the cost of these calls.</p>
        <!-- Button -->
        <div class="form-group">
          <div class="col-md-4 col-md-push-5"> <?php echo $formelem->button(array('id'=>'btn-signup','name'=>'btn-signup','class'=>'btn btn-primary registerBtn', 'value'=>'Create Account')); ?> </div>
        </div>
      </fieldset>
      <?php echo $formelem->close(); ?> </div>
  </div>
</div>
</div>
<!-- /.container -->
<script src="js/jquery-1.10.2.js"></script>
<?php include 'components/footer.php'; ?>
<script src="js/jquery.jCombo.min.js"></script>
<script type="text/javascript">
	//$('#country').append('<option value="Select country" selected="selected">Select country</option>');
	//$("#country option:first").after("<option selected='selected'>Select country</option>");
	$("#country option:first").text("Select country");
</script>
