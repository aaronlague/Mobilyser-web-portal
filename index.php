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
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-inverse" role="navigation">
<div class="container">
<div class="row">
  <div class="navbar-header col-lg-5"><a href="index.php"><img src="images/image-logo.png" border="0" /></a></div>
  <!--login form goes here-->
  <div class="loginSection col-lg-3 col-lg-offset-3">
  <?php echo $formelem->create(array('method'=>'post','class'=>'form-horizontal loginFormSection')); ?>
  <fieldset>
  <div class="form-group <?php echo $emailFlag['class'] ?> "><?php echo $formelem->text(array('id'=>'email','name'=>'email','placeholder'=>'Username','class'=>'form-control input-sm '.$emailFlag['class'].'', 'value'=>$email)); ?> <span class="input-icon fui-user"></span> </div>
  <div class="form-group <?php echo $pwordFlag['class'] ?>"><?php echo $formelem->password(array('id'=>'password','name'=>'password','placeholder'=>'Password','class'=>'form-control input-sm '.$pwordFlag['class'].'')); ?> <span class="input-icon fui-lock"></span> </div>
  <?php if(isset($_POST['btn-login'])){ echo $indexController->indexPage($email, $password, $activationcodeURL, $connect); } ?>
  </div>
  <div class="submitContainer col-lg-1">
    <p><a href="forgotpassword.php">Lost your password?</a></p>
    <?php echo $formelem->button(array('id'=>'btn-login','name'=>'btn-login','class'=>'btn btn-sm btn-primary btn-login', 'value'=>'Login')); ?> </div>
  </fieldset>
  <?php echo $formelem->close(); ?> </div>
<!-- /.container -->
</nav>
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
      <div class="splashContent col-lg-5">
        <h2>Why use Mobilyser</h2>
		<h6>Tax</h6>
        <p>Call related data collected by Mobilyser can be used at the ends of the tax year to support your tax return. Mobilyser reduces your tax liability, whilst providing vital evidence should your tax affairs be audited by the Australian Tax Office.</p>
		<h6>Expenses</h6>
        <p>Mobilyser provides an accuratre way of capturing the exact amount you spend each month on work related calls. You can use this data to submit a valid expense claim to your employer.</p>
		<h6>Costs</h6>
        <p>Many organisations struggle to keeo control of mobile service costs. Mobilyser reduces these costs by effectively managing the cost of mobile phone plans.</p>
      </div>
      <div class="col-lg-6 col-lg-offset-1">
        <div class="row" style="">
          <div class="col-xs-4 col-md-2 col-lg-4" style=""><img src="images/image-mobile-hp.png" border="0" /> </div>
          <div class="col-xs-4 col-md-2 col-lg-4" style=""><img src="images/image-tracking-hp.png" border="0" /> </div>
          <div class="col-xs-4 col-md-2 col-lg-4" style=""><img src="images/image-analysis-hp.png" border="0" /> </div>
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
        <div class="copyrightNote col-lg-5"> <span>&copy; Copyright 2014 Mobilyser.  All rights reserved.</span> </div>
        <div class="footerNavs col-lg-1"> <img src="images/image-footer-logo-hp.png" border="0"> </div>
        <div class="footerNavs col-lg-1"> <a href="#">Home</a> </div>
        <div class="footerNavs col-lg-1"> <a href="#">Privacy</a> </div>
        <div class="footerNavs col-lg-1"> <a href="#">Terms</a> </div>
        <div class="footerNavs col-lg-2"> <a href="#">Follow Us</a> </div>
        <div class="footerNavs col-lg-1"> <span class="fui-facebook"></span> <span class="fui-twitter"></span> </div>
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
</body>
</html>
