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
<!--<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">-->
<nav class="navbar navbar-inverse" role="navigation">
  <div class="container">
    <div class="row">
      <div class="navbar-header col-lg-5">
	  	<img src="images/image-logo.png" border="0" />
	  </div>
      <!--login form goes here-->
      <div class="loginSection col-lg-3 col-lg-offset-3">
	  	<div class="form-group">
            <input type="text" placeholder="Username" class="form-control input-sm">
            <span class="input-icon fui-lock"></span>
        </div>
		<div class="form-group">
			<input type="text" placeholder="Password" class="form-control input-sm">
            <span class="input-icon fui-lock"></span>
		</div>
	  </div>
	  <div class="col-lg-1" style="margin-top:45px;">
	  	<a href="#">Lost your password</a>
	  </div>
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
	  <div class="col-lg-6 col-lg-push-1">
	  <div class="row">
	  	<div class="col-lg-2" style="width:170px;">
			<img src="images/image-mobile-hp.png" border="0" />
		</div>
		<div class="col-lg-2" style="width:170px;">
			<img src="images/image-tracking-hp.png" border="0" />
		</div>
		<div class="col-lg-2" style="width:170px;">
			<img src="images/image-tracking-hp.png" border="0" />
		</div>
	  </div>
	  </div>
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->
</div>
<!-- /.section -->
<div class="container">
  <hr>
  <footer>
    <div class="row">
      <div class="col-lg-12">
        <p>Mobilyser &copy; 2013</p>
      </div>
    </div>
  </footer>
</div>
<!-- /.container -->
<!-- JavaScript -->
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>
