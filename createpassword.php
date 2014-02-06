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

$activationFlag['class'] = '';
$passwordFlag['class'] = '';
$cpasswordFlag['class'] = '';

if(isset($_POST['btn-create'])){
    
    $activationFlag = $validationlib->isEmpty($_POST['activationCode'], '', 2);
    $passwordFlag = $validationlib->isEmpty($_POST['password'], '', 2);
    $cpasswordFlag = $validationlib->isEmail($_POST['confirmPassword'], '', 5, 'y');

    if($activationFlag['message'] == "" and $passwordFlag['message'] == "" and $cpasswordFlag['message'] == ""){

      $data['@password'] = '';
      $data['@firstname'] = $_POST['firstname'];
      $data['@lastname'] = $_POST['lastname'];
      $data['@email'] = $_POST['email'];
      
      $db->mquery_insert("dbo.createAccount", $data, $connect);

      header("Location: confirmation.php");

    }

}

?>
<?php include 'components/header.php'; ?>

<div class="container">
  <div class="row">
    <div class="col-lg-12" style="text-align:center;">
      <h2 class="">Create Password</h2>
	  <sup><i class="fa fa-asterisk" style="color:red;"></i></sup> <span><strong> - Mandatory Field</strong></span>
    </div>
  </div>
  <hr />
  <div class="row">
    <div class="col-lg-8 col-lg-push-2">
      <h3 style="text-align:center">Password Details</h3>
      <p style="background-color: #ccc; padding: 15px; margin-bottom: 20px;">To start the password creation process please provide the Activation code you received and your desired password.</p>
      <div class="row">
        <div class="col-lg-12 regFormSection"> <?php echo $formelem->create(array('method'=>'post','class'=>'form-horizontal')); ?>
          <fieldset>
            <!-- Text input-->
            <div class="form-group">
              <div class="col-md-12"><?php echo $formelem->text(array('id'=>'activationCode','name'=>'activationCode','placeholder'=>'Activation code','class'=>'form-control input-md '.$fnameFlag['class'].'','required'=>'')); ?><span class="required">*</span></div>
            </div>
            <!-- Text input-->
            <div class="form-group">
              <div class="col-md-12"><?php echo $formelem->text(array('id'=>'password','name'=>'lpassword','placeholder'=>'Password','class'=>'form-control input-md '.$lnameFlag['class'].'','required'=>'')); ?><span class="required">*</span></div>
            </div>
            <!-- Text input-->
            <div class="form-group">
              <div class="col-md-12"><?php echo $formelem->text(array('id'=>'confirmPassword','name'=>'confirmPassword','placeholder'=>'Confirm password','class'=>'form-control input-md '.$emailFlag['class'].'','required'=>'')); ?><span class="required">*</span></div>
            </div>
            <!-- Button -->
            <div class="form-group" style="text-align:center;">
              <div class="col-md-12"> <?php echo $formelem->button(array('id'=>'btn-create','name'=>'btn-create','class'=>'btn btn-primary registerBtn', 'value'=>'Create password')); ?> </div>
            </div>
          </fieldset>
          <?php echo $formelem->close(); ?> </div>
      </div>
    </div>
  </div>
</div>
<!-- /.container -->
<script src="js/jquery-1.10.2.js"></script>
<?php include 'components/footer.php'; ?>
