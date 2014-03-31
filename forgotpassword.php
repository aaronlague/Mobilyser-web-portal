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

$email = '';

if(isset($_POST['btn-sendPass'])){
	
	$email = $_POST['email'];
	$indexController->forgotPasswordQuery($email, $connect);

}

$country_data = $lookupmodel->getCountry($connect);

?>
<?php include 'components/header.php'; ?>
<div class="section formHeadLine">
<div class="container">
	<div class="row">
    <div>
      <h3>Forgot your password?</h3>
	</div>
  </div>
</div>
</div>
<div class="forgotPasswordContainer container">
  <div class="row">
    <div class="forgotPasswordSection col-lg-10 col-lg-offset-1">
	<p>Please enter your email address below. You will receive an email with further instructions on resetting your password. </p>
	<?php echo $formelem->create(array('method'=>'post','class'=>'form-horizontal forgotPasswordFormSection')); ?>
      <fieldset>
        <!-- Text input-->
        <div class="form-group">
		  <?php echo $emailFlag['message']; ?>	
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
<script src="js/field-validator.js"></script>
<script src="js/core.js"></script>
<?php include 'components/footer.php'; ?>