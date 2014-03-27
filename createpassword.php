<?php
session_start();

include 'protected/config/db_config.php';
include 'protected/config/html_config.php';
include 'protected/library/validation_library.php';
include 'protected/controllers/index.php';

$db = new db_config();
$formelem = new FormElem();
$validationlib = new validationLibrary();
$indexController = new IndexController();

$connect = $db->connect();

$activationFlag['class'] = '';
$passwordFlag['class'] = '';
$cpasswordFlag['class'] = '';

$emailValue = $_GET['email'];
$verificationCode = $_GET['verification'];



if(isset($_POST['btn-create'])){
	
	$indexController->createUserPassword($emailValue, $verificationCode, $_POST['lpassword'], $connect);

}

?>
<?php include 'components/header.php'; ?>

<div class="section formHeadLine">
  <div class="container">
    <div class="row">
      <div>
        <h3>Create your password</h3>
      </div>
    </div>
  </div>
</div>
<div class="createPasswordContainer container">
  <div class="row">
    <div class="createPasswordSection col-lg-10 col-lg-offset-1">
      <h4>Password details</h4>
      <p>Please choose a password containing more than 6 characters, including at least one number or special character. Example: eXpr3$$</p>
      <div class="row">
        <div class="noteTxt"> <span><strong>Mandatory field</strong></span><sup><i class="fa fa-asterisk"></i></sup> </div>
      </div>
      <?php echo $formelem->create(array('method'=>'post','class'=>'form-horizontal')); ?>
      <fieldset>
      <!-- Text input-->
      <div class="form-group"> <?php echo $passwordFlag['message']; ?> <?php echo $checkPasswordFlag['message']; ?>
        <div class="col-md-12"><?php echo $formelem->text(array('id'=>'password','name'=>'lpassword','placeholder'=>'Password*','class'=>'form-control input-md '.$checkPasswordFlag['class'].'', 'value'=>$password)); ?></div>
      </div>
      <!-- Text input-->
      <div class="form-group"> <?php echo $passwordFlag['message']; ?> <?php echo $reTypePasswordFlag['message']; ?>
        <div class="col-md-12"><?php echo $formelem->text(array('id'=>'confirmPassword','name'=>'confirmPassword','placeholder'=>'Confirm password*','class'=>'form-control input-md '.$reTypePasswordFlag['class'].'', 'value'=>$rePassword)); ?></div>
      </div>
      <!-- Button -->
      <div class="submitContainer form-group">
        <div class="col-md-12"> <?php echo $formelem->button(array('id'=>'btn-create','name'=>'btn-create','class'=>'btn btn-primary registerBtn', 'value'=>'Create password')); ?> </div>
      </div>
      </fieldset>
      <?php echo $formelem->close(); ?> </div>
  </div>
</div>
<!-- /.container -->
<script src="js/jquery-1.10.2.js"></script>
<?php include 'components/footer.php'; ?>
