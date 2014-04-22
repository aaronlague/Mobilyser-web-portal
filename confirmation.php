<?php
session_start();

include 'protected/config/db_config.php';
include 'protected/config/html_config.php';
include 'protected/library/validation_library.php';
include 'protected/library/confirmation_headings.php';
include 'protected/controllers/index.php';

$db = new db_config();
$formelem = new FormElem();
$validationlib = new validationLibrary();
$indexController = new IndexController();

$connect = $db->connect();

include 'protected/config/login_config.php';

?>
<?php include 'components/header.php'; ?>
<div class="section formHeadLine">
	<div class="container">
	  <div class="row">
		<div>
		  <h3><?php echo $heading; ?></h3>
		</div>
	  </div>
	</div>
</div>
<div class="container">
  <div class="row">
    <div class="col-lg-8 col-lg-push-2">
	<br />
	  <?php include 'components/modal-alerts.php'; ?>
  </div>
</div>
<!-- /.container -->
<script src="js/jquery-1.10.2.js"></script>
<script src="js/modal-actions.js"></script>
<?php include 'components/footer.php'; ?>
<?php include 'components/alert-scripts.php'; ?>
