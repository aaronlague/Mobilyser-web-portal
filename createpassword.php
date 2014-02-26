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

$activationFlag['class'] = '';
$passwordFlag['class'] = '';
$cpasswordFlag['class'] = '';

if(isset($_POST['btn-create'])){

	$userIdFlag = $db->escape($_GET['userid']);
    $activationFlag = $validationlib->isEmpty($_POST['activationCode'], 'Activation code', 2);
	$checkPasswordFlag = $validationlib->isEmpty($_POST['lpassword'], 'Password', 2);
	$reTypePasswordFlag = $validationlib->isEmpty($_POST['confirmPassword'], 'Password confirmation', 2);
    $passwordFlag = $validationlib->isCompare($_POST['lpassword'], $_POST['confirmPassword'], 'Passwords', 3);

    //if($activationFlag['message'] == "" and $passwordFlag['message'] == ""){
//
//      $indexController->indexPage($userIdFlag, $_POST['lpassword'], $_POST['activationCode'], $connect);
//
//    }

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
      <p>To start the password creation process please provide the Activation code you received and your desired password.</p>
      <div class="row">
        <div class="noteTxt"> <span><strong>Mandatory field</strong></span><sup><i class="fa fa-asterisk"></i></sup> </div>
      </div>
      <?php echo $formelem->create(array('method'=>'post','class'=>'form-horizontal')); ?>
      <fieldset>
      <!-- Text input-->
      <div class="form-group"> <?php echo $activationFlag['message']; ?>
        <div class="col-md-12"><?php echo $formelem->text(array('id'=>'activationCode','name'=>'activationCode','placeholder'=>'Activation code*','class'=>'form-control input-md '.$activationFlag['class'].'', 'value'=>$activationCode)); ?></div>
      </div>
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
