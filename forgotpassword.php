<?php
session_start();

include 'protected/config/db_config.php';
include 'protected/config/html_config.php';
include 'protected/library/validation_library.php';
include 'protected/models/lookup.php';
include 'protected/controllers/index.php';

$db = new db_config();
$formelem = new FormElem();
$validationlib = new validationLibrary();
$lookupmodel = new LookupModel();
$indexController = new IndexController();

$connect = $db->connect();

$activationcodeURL = '';

$emailFlag['class'] = '';
$pwordFlag['class'] = '';

//if(isset($_POST['btn-login'])){
//
//    $email = $db->escape($_POST['email']);
//    $password = $db->escape($_POST['password']);
//    
//    $emailFlag = $validationlib->isEmail($email, '', 3, 'n');
//    $pwordFlag = $validationlib->isEmpty($password, '', 1);
//    if($emailFlag['message'] == "" and $pwordFlag['message'] == ""){
//      $indexController->indexPage($email, $password, $activationcodeURL, $connect);
//    }
//
//}

$fnameFlag['class'] = '';
$lnameFlag['class'] = '';
$emailFlag['class'] = '';
$mobileFlag['class'] = '';

//if(isset($_POST['btn-register'])){
//    
//    $fnameFlag = $validationlib->isEmpty($_POST['firstname'], '', 2);
//    $lnameFlag = $validationlib->isEmpty($_POST['lastname'], '', 2);
//    $emailFlag = $validationlib->isEmail($_POST['email'], '', 5, 'y');
//    $mobileFlag = $validationlib->isEmpty($_POST['mobileNumber'], '', 5);
//
//    if($fnameFlag['message'] == "" and $lnameFlag['message'] == "" and $emailFlag['message'] == "" and $mobileFlag['message']){
//
//      $data['@password'] = '';
//      $data['@firstname'] = $_POST['firstname'];
//      $data['@lastname'] = $_POST['lastname'];
//      $data['@email'] = $_POST['email'];
//      $data['@country'] = $_POST['country'];
//      //$data['@company'] = $_POST['companyname'];
//      $data['@mobilephone'] = '09226885956';
//      $data['@acct_no'] = $_POST['accountNumber'];
//      //$data['@telecom'] = $_POST['telco'];
//      
//      $db->mquery_insert("dbo.createAccount", $data, $connect);
//
//      header("Location: confirmation.php");
//
//    }
//
//}

$country_data = $lookupmodel->getCountry($connect);

//$plantype_data = array(
//  '1'=>'Plan A',
//  '2'=>'Plan B',
//  '3'=>'Plan C'
//);
?>
<?php include 'components/header.php'; ?>

<div class="forgotPasswordContainer container">
  <div class="row">
    <div class="forgotPasswordSection col-lg-8 col-lg-push-2">
	<h2>Forgot your password?</h2>
	<p>Please enter your email address below to recieve a password reset message</p>
	<?php echo $formelem->create(array('method'=>'post','class'=>'form-horizontal forgotPasswordFormSection')); ?>
      <fieldset>
        <!-- Text input-->
        <div class="form-group">
          <div class="col-md-12"><?php echo $formelem->text(array('id'=>'email','name'=>'email','placeholder'=>'Email','class'=>'form-control input-md '.$fnameFlag['class'].'','required'=>'')); ?><span class="required">*</span></div>
        </div>
		<!-- Button -->
        <div class="submitContainer form-group">
          <div class="col-md-12"> <?php echo $formelem->button(array('id'=>'btn-sendPass','name'=>'btn-sendPass','class'=>'btn btn-primary registerBtn', 'value'=>'Email password')); ?> </div>
        </div>
      </fieldset>
      <?php echo $formelem->close(); ?> </div>
  </div>
</div>
<!-- /.container -->
<script src="js/jquery-1.10.2.js"></script>
<?php include 'components/footer.php'; ?>