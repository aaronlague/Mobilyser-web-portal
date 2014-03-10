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
    
    $emailFlag = $validationlib->isEmail($email, 'Email entered is', 3, 'n');
    $pwordFlag = $validationlib->isEmpty($password, 'Password', 1);
	
    
	if($emailFlag['message'] == "" and $pwordFlag['message'] == ""){
      $indexController->indexPage($email, $password, $activationcodeURL, $connect);
	}

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta name="description" content="">
<meta name="author" content="">
<title>Mobilyser</title>
<!-- Bootstrap core CSS -->
<link href="css/bootstrap.css" rel="stylesheet">
<!-- Add custom CSS here -->
<link href="css/modern-business.css" rel="stylesheet">
<link href="css/flat-ui.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">
<link href="css/media-query.css" rel="stylesheet">
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-inverse" role="navigation">
	<div class="container">
		<div class="row">
  			<div class="navbar-header col-lg-5 col-xs-8">
				<a href="index.php"><img class="img-responsive" src="images/image-logo.png" border="0" /></a>
			</div>
  <!--login form goes here-->
			<div class="loginSection col-lg-3 col-lg-offset-3 col-xs-4">
				<?php echo $formelem->create(array('method'=>'post','class'=>'form-horizontal loginFormSection')); ?>
					<fieldset>
						<div class="form-group <?php echo $emailFlag['class'] ?> ">
							<?php echo $formelem->text(array('id'=>'email','name'=>'email','placeholder'=>'Username','class'=>'form-control input-sm '.$emailFlag['class'].'', 'value'=>$email)); ?>
							<span class="input-icon fui-user"></span>
						</div>
						<div class="form-group <?php echo $pwordFlag['class'] ?>">
							<?php echo $formelem->password(array('id'=>'password','name'=>'password','placeholder'=>'Password','class'=>'form-control input-sm '.$pwordFlag['class'].'')); ?>
							<span class="input-icon fui-lock"></span>
						</div>
				 <?php if(isset($_POST['btn-login'])){ echo $indexController->indexPage($email, $password, $activationcodeURL, $connect); } ?>
			</div>
			<div class="submitContainer col-lg-1 col-xs-4">
				<p><a href="forgotpassword.php">Lost your password?</a></p>
				<?php echo $formelem->button(array('id'=>'btn-login','name'=>'btn-login','class'=>'btn btn-sm btn-primary btn-login', 'value'=>'Login')); ?>
			</div>
  					</fieldset>
  				<?php echo $formelem->close(); ?>
  		</div>
	</div>
</nav>
<div class="modal" id="modalTerms">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close fui-cross" data-dismiss="modal" aria-hidden="true"></button>
          <h4 class="modal-title">Terms and Conditions</h4>
        </div>
        <div class="modal-body">
          If you use this site, you are responsible for maintaining the confidentiality of your account and password and for restricting access to your computer, and you agree to accept responsibility for all activities that occur under your account or password. Mobilyser and its associates reserve the right to refuse service, terminate accounts, remove or edit content, or cancel orders in their sole discretion. 
        </div>
        <div class="modal-footer">
          <a href="#" data-dismiss="modal" class="btn btn-primary btn-decline">Decline</a>
          <a href="#" class="btn btn-primary">Accept</a>
        </div>
      </div>
    </div>
</div>
<div class="modal" id="modalDecline">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close fui-cross" data-dismiss="modal" aria-hidden="true"></button>
          <h4 class="modal-title">Terms of use</h4>
        </div>
        <div class="modal-body">
			In order to use the Mobilyser service you are required to accept the terms of use. If you have any specific concerns about the terms of user for Mobilyser please contact <a href="mailto:support@mobilyser.net">support@mobilyser.net</a>
        </div>
        <!--<div class="modal-footer">
          <a href="#" data-dismiss="modal" class="btn btn-primary">Decline</a>
          <a href="#" class="btn btn-primary">Accept</a>
        </div>-->
      </div>
    </div>
</div>
<div class="section topContent">
  <div class="container">
    <div class="col-lg-8 col-lg-offset-2">
      <h1>Analyse your mobile calls to claim an expense or prepare your tax return.</h1>
      <a class="btn btn-lg btn-primary" href="register.php">Sign up today</a> </div>
  </div>
</div>
<div class="section">
  <div class="splashColumn container">
    <div class="row">
      <div class="splashContent col-lg-6">
        <h2>Save time and money!</h2>
        <p>By simply tagging your calls into work and personal categories Mobilyser can analyse your monthly bills, providing you with an accurate figure that you can claim as an expense.  
Mobilyser makes record keeping a breeze and empowers the user with exact figures come tax time. It is a great tool for both employers and employees.</p>
      </div>
      <div class="col-lg-6 col-lg-offset">
        <div class="row" style="">
          <div class="col-xs-4 col-md-2 col-lg-4" style=""><img class="img-responsive" src="images/image-mobile-hp.png" border="0" /> </div>
          <div class="col-xs-4 col-md-2 col-lg-4" style=""><img class="img-responsive" src="images/image-tracking-hp.png" border="0" /> </div>
          <div class="col-xs-4 col-md-2 col-lg-4" style=""><img class="img-responsive" src="images/image-analysis-hp.png" border="0" /> </div>
        </div>
      </div>
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->
</div>
<!-- /.section -->
<section class="bottomContent">
  <div class="bottomContentContainer container" style="text-align:center;">
    <div class="row">
      <div class="col-lg-8 col-lg-offset-2">
        <h2>How Mobilyser works</h2>
        <br />
        <div id="slider" class="ui-slider"></div>
        <input type="hidden" id="amount" style="border:0;" />
		<div class="row">
			<div id="slideNavs" class="slideNavigationWrapper">
				<div class="slideNavigationContainer">
				<span class="fui-arrow-left" id="leftNav"></span>
				<span class="fui-arrow-right" id="rightNav"></span>
				</div>
			</div>
		</div>
        <ul class="range-slider-slides" id="imageHolder" style="">
          <li style="display:block;" class="active">
            <div>
			  <img src="images/image-slide-setup.png" border="0">
              <p>Provide selected information about your telco plan to help Mobilyser calculate an estimated cost for each call.</p>
            </div>
          </li>
          <li style="display:none;">
            <div>
			  <img src="images/image-slide-call.png">
              <p>Mobilyser tracks each call you make, providing an estimate of the call cost.</p>
            </div>
          </li>
          <li style="display:none;">
            <div>
			  <img src="images/image-slide-tagging.png">
              <p>Mobilyser automatically ‘tags’ calls as either being work or personal related. New numbers dialled are flagged by Mobilyser. You review the tags to check that the correct label has been applied.</p>
            </div>
          </li>
          <li style="display:none;">
            <div>
			  <img src="images/image-slide-upload.png">
              <p>At the end of each month, upload your bill* to the Mobilyser portal. Call related data will be extracted for you to review.</p>
            </div>
          </li>
          <li style="display:none;">
            <div>
			  <img src="images/image-slide-reporting.png">
              <p>Produce a report showing how much Mobilyser estimates you can claim. Use this information to claim an expense from your employer or collate for your end of year tax return.</p>
            </div>
          </li>
          <li style="display:none;">
            <div>
			  <img src="images/image-slide-claim.png">
              <p>Mobilyser provides you with the accurate data you need to make a valid expense claim or provide evidence to support an end of year tax return.</p>
            </div>
          </li>
        </ul>
        <br />
        <br />
      </div>
    </div>
  </div>
</section>
<section class="footerSection">
  <div class="container">
    <div class="footerContainer col-lg-10 col-lg-push-1">
      <footer>
        <div class="copyrightNote col-lg-5 col-xs-5"> <span>&copy; Copyright 2014 Mobilyser.  All rights reserved.</span> </div>
        <div class="footerNavs col-lg-3 col-xs-3 col-lg-offset-1" style="padding-left:0!important; margin-left:7.333333%!important;"> <img src="images/image-footer-logo-hp.png" border="0"> </div>
        <div class="footerNavs col-lg-1 col-xs-1"> <a href="#">Home</a> </div>
        <div class="footerNavs col-lg-1 col-xs-1"> <a href="#">Privacy</a> </div>
        <div class="footerNavs col-lg-1 col-xs-1"> <a href="#">Terms</a> </div>
        <!--<div class="footerNavs col-lg-2"> <a href="#">Follow Us</a> </div>
        <div class="footerNavs col-lg-1"> <span class="fui-facebook"></span> <span class="fui-twitter"></span> </div>-->
      </footer>
    </div>
  </div>
</section>
<!-- /.container -->
<!-- JavaScript -->
<script src="js/jquery-1.10.2.js"></script>
<script src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap-switch.js"></script>
<script src="js/application.js"></script>
<script src="js/hp-range-slides.js"></script>
<script src="js/jquery.toggler.js"></script>
<script type="text/javascript">
(function($) {
	$(document).ready(function() {
		$('#modalTerms').toggler();	
	});
	$('.fui-cross').click(function(){
		$('#modalTerms').modal();
		$('#modalTerms').modal('hide');	
	});
	$('.btn-decline').click(function(){
		$('#modalTerms').modal();
		$('#modalTerms').modal('hide');
		$('#modalDecline').modal();
		$('#modalDecline').modal('show');
	});
})(jQuery);
</script>
</body>
</html>
