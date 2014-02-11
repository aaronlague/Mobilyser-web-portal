<?php
session_start();

//include 'protected/config/db_config.php';
include 'protected/config/html_config.php';
include 'protected/library/validation_library.php';
include 'protected/controllers/index.php';

//$db = new db_config();
$formelem = new FormElem();
$validationlib = new validationLibrary();
$indexController = new IndexController();

//$connect = $db->connect();

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
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
  <div class="navbar-header col-lg-5"> <img src="images/image-logo.png" border="0" /> </div>
  <!--login form goes here-->
  <div class="loginSection col-lg-3 col-lg-offset-3">
    <div class="form-group" style="margin-bottom:5px!important;">
      <input type="text" placeholder="Username" class="form-control input-sm">
	  <span class="input-icon fui-user">
    </div>
    <div class="form-group">
      <input type="text" placeholder="Password" class="form-control input-sm">
      <span class="input-icon fui-lock"></span>
	</div>
  </div>
  <div class="col-lg-1" style="margin-top:45px;">
    <p style="line-height:1!important; font-size:12px;"><a href="#fakelink">Lost your password?</a></p>
    <a href="#fakelink" class="btn btn-sm btn-primary">Login</a> </div>
  <!--login form ends here-->
</div>
<!-- /.container -->
</nav>
<div class="section topContent">
  <div class="container">
    <h1>Analyse your mobile calls to claim an expense or prepare your tax return.</h1>
    <a class="btn btn-lg btn-primary" href="register.php">Sign Up Now!</a> </div>
</div>
<div class="section">
  <div class="splashColumn container">
    <div class="row">
      <div class="splashContent col-lg-5">
        <h2>Save time and money!</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.</p>
      </div>
      <div class="col-lg-6 col-lg-offset-1">
        <div class="row" style="padding-left: 75px;">
          <div class="col-lg-2" style="width:170px; text-align:center;"> <img src="images/image-mobile-hp.png" border="0" /> </div>
          <div class="col-lg-2" style="width:170px;"> <img src="images/image-tracking-hp.png" border="0" /> </div>
          <div class="col-lg-2" style="width:170px;"> <img src="images/image-tracking-hp.png" border="0" /> </div>
        </div>
      </div>
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->
</div>
<!-- /.section -->
<section class="bottomContent" style="background-color:#ecf0f1; border-bottom:1px solid #dee1e4;">
  <div class="bottomContentContainer container" style="text-align:center;">
    <div class="row">
      <div class="col-lg-8 col-lg-offset-2">
        <h2>The process</h2>
        <br />
        <!--<img src="images/image-bottom-slider-hp.png" border="0">-->
		<div id="slider" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" aria-disabled="false"><div class="ui-slider-segment" style="margin-left: 25%;"></div><div class="ui-slider-segment" style="margin-left: 25%;"></div><div class="ui-slider-segment" style="margin-left: 25%;"></div><div class="ui-slider-range ui-widget-header ui-corner-all ui-slider-range-min" style="width: 50%;"></div><a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 50%;"></a></div>
		<br />
		<br />
        <img src="images/image-caller-tags-hp.png" border="0">
		<h3>Tag a phone call</h3>
	   <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
	   </div>
    </div>
    <div class="row">
	</div>
  </div>
</section>
<section>
<div class="container">
<div class="col-lg-10 col-lg-push-1" style="padding-right:0!important; padding-left:0!important; margin-bottom:20px;">
	<footer style="margin-top:20px!important;">
		<div class="col-lg-5">
			<span style="font-size:12px; color:#c0c5ca;">© Copyright 2014 Mobilyser.  All rights reserved.</span>
		</div>
		<div class="col-lg-1">
			<img src="images/image-footer-logo-hp.png" border="0">
		</div>
		<div class="col-lg-1">
			<a style="font-size:12px; color:#c0c5ca;" href="#">Home</a>
		</div>
		<div class="col-lg-1">
			<a style="font-size:12px; color:#c0c5ca;" href="#">Privacy</a>
		</div>
		<div class="col-lg-1">
			<a style="font-size:12px; color:#c0c5ca;" href="#">Terms</a>
		</div>
		<div class="col-lg-2">
			<a style="font-size:12px; color:#c0c5ca;" href="#">Follow Us</a> 
		</div>
		<div class="col-lg-1" style="color:#c0c5ca;">
			<span style="padding-right:10px;" class="fui-facebook"></span>
			<span class="fui-twitter"></span>
		</div>
	</footer>
</div>
</div>
</section>
<!-- /.container -->
<!-- JavaScript -->
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap-switch.js"></script>
</body>
</html>
