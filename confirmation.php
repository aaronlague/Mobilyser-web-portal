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

?>
<?php include 'components/header.php'; ?>
<div class="section formHeadLine">
	<div class="container">
	  <div class="row">
		<div>
		  <h3>Thank you for registering a new Mobilyser account</h3>
		</div>
	  </div>
	</div>
</div>
<div class="container">
  <div class="row">
    <div class="col-lg-8 col-lg-push-2">
	<br />
      <p style="background-color: #ccc; padding: 15px; margin-bottom: 20px; text-align:center;">In order to complete your registration we have sent you an email. Please click the confirmation link in the email to complete your registration.</p>
  </div>
</div>
<!-- /.container -->
<script src="js/jquery-1.10.2.js"></script>
<?php include 'components/footer.php'; ?>
