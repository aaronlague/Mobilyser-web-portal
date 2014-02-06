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


?>
<?php include 'components/header.php'; ?>

<div class="container">
  <div class="row">
    <div class="col-lg-12" style="text-align:center;">
      <h2>Thank You</h2>
    </div>
  </div>
  <hr />
  <div class="row">
    <div class="col-lg-8 col-lg-push-2">
      <h3 style="text-align:center">Account signup success!</h3>
      <p style="background-color: #ccc; padding: 15px; margin-bottom: 20px;">We have sent you an email with a confirmation link to validate your registration</p>
  </div>
</div>
<!-- /.container -->
<script src="js/jquery-1.10.2.js"></script>
<?php include 'components/footer.php'; ?>
