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
?>
<?php include 'components/header.php'; ?>

<div class="section termsHeadline">
<div class="container">
	<div class="row">
    <div>
      <h3>Terms of use</h3>
	</div>
  </div>
</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-lg-12 termsContent">
			<p>If you use this site, you are responsible for maintaining the confidentiality of your account and password and for restricting access to your computer, and you agree to accept responsibility for all activities that occur under your account or password. Mobilyser and its associates reserve the right to refuse service, terminate accounts, remove or edit content, or cancel orders in their sole discretion.
		  <br />
		  In order to use the Mobilyser service you are required to accept the terms of use. If you have any specific concerns about the terms of user for Mobilyser please contact <a href="mailto:support@mobilyser.net">support@mobilyser.net</a>
			</p>
			<a href="accounts.php" class="btn btn-primary btn-back">Back to home</a>
		</div>		
	</div>
</div>
<!-- /.container -->
<script src="js/jquery-1.10.2.js"></script>
<script src="js/field-validator.js"></script>
<script src="js/core.js"></script>
<?php include 'components/footer.php'; ?>
