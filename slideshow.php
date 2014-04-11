<?php
session_start();

include 'protected/config/db_config.php';
include 'protected/config/html_config.php';
include 'protected/library/validation_library.php';
include 'protected/models/lookup.php';
include 'protected/controllers/index.php';

require("components/plugins/class.phpmailer.php");
require("components/plugins/class.smtp.php");
require("components/plugins/PHPMailerAutoload.php");
require("components/plugins/mailer.setup.php");

$db = new db_config();
$formelem = new FormElem();
$validationlib = new validationLibrary();
$lookupmodel = new LookupModel();
$indexController = new IndexController();

$connect = $db->connect();
?>
<?php include 'components/header.php'; ?>
<div class="section formHeadLine">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 slideShowBlurb">
				<h1>Welcome to Mobilyser.</h1>
				<p>Highlighted below are the key components of the Mobilyser portal.  We're still refining these features, ensuring they meet the expectations of people preparing their tax returns or claiming an expense. </p>
			</div>
			<div class="col-lg-12 slideShowContainer">
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
 
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>
 
  <!-- Slider Content (Wrapper for slides )-->
  <div class="carousel-inner">
    <div class="item active">
      <img src="http://placehold.it/350x350">
      <div class="carousel-caption">
      </div>
    </div>
	<div class="item active">
      <img src="http://placehold.it/350x350">
      <div class="carousel-caption">
      </div>
    </div>
	<div class="item active">
      <img src="http://placehold.it/350x350">
      <div class="carousel-caption">
      </div>
    </div>
  </div>
 
  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
</div>
			</div>
		</div>
	</div>
</div>
<!-- /.container -->
<script src="js/jquery-1.10.2.js"></script>
<script src="js/modal-actions.js"></script>
<script src="js/core.js"></script>
<?php include 'components/footer.php'; ?>