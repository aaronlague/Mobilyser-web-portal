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
    <div class="form-group <?php echo $emailFlag['class'] ?> "><?php echo $formelem->text(array('id'=>'email','name'=>'email','placeholder'=>'Username','class'=>'form-control input-sm '.$emailFlag['class'].'', 'value'=>$email)); ?>
      <span class="input-icon fui-user"></span>
	</div>
    <div class="form-group <?php echo $pwordFlag['class'] ?>"><?php echo $formelem->password(array('id'=>'password','name'=>'password','placeholder'=>'Password','class'=>'form-control input-sm '.$pwordFlag['class'].'')); ?>
      <span class="input-icon fui-lock"></span>
	</div>
	<?php if(isset($_POST['btn-login'])){ echo $indexController->indexPage($email, $password, $activationcodeURL, $connect); } ?>
    </div>
    <div class="submitContainer col-lg-1">
      <p><a href="forgotpassword.php">Lost your password?</a></p>
      <?php echo $formelem->button(array('id'=>'btn-login','name'=>'btn-login','class'=>'btn btn-sm btn-primary btn-login', 'value'=>'Login')); ?>
    </div>
  </fieldset>
  <?php echo $formelem->close(); ?>
</div>
<!-- /.container -->
</nav>
<div class="section topContent">
  <div class="container">
  	<div class="col-lg-8 col-lg-offset-2">
    <h1>Analyse your mobile calls to claim an expense or prepare your tax return.</h1>
    <a class="btn btn-lg btn-primary" href="register.php">Sign up today</a>
	</div>
  </div>
</div>
<div class="section">
  <div class="splashColumn container">
    <div class="row">
      <div class="splashContent col-lg-5">
        <h2>Save time and money!</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.</p>
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
        <h2>The process</h2>
        <br />
        <div id="slider" class="ui-slider"></div>
		<input type="hidden" id="amount" style="border:0; color:#f6931f; font-weight:bold;" />
 		<ul id="imageHolder" style="list-style:none; list-style: none; margin-left: 0; list-style-position: outside;">
			<li style="display:block;" class="active">
			<img src="images/image-slide-setup.png" border="0">
        	<h3>Tag a phone call</h3>
        	<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
			</li>
			<li style="display:none;"><div><img src="images/image-slide-call.png"></div></li>
			<li style="display:none;"><div><img src="images/image-slide-tagging.png"></div></li>
			<li style="display:none;"><div><img src="images/image-slide-upload.png"></div></li>
			<li style="display:none;"><div><img src="images/image-slide-reporting.png"></div></li>
			<!--<li style="display:none;"><div><img src="images/image-slide-claim.png"></div></li>-->
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
<script>
$(document).ready(function(){
	var dom = {
		imageToHideFirst: $( "#imageHolder li:nth-child(2), #imageHolder li:nth-child(3), #imageHolder li:nth-child(4), #imageHolder li:nth-child(5)" ),
		imageToHideSecond: $( "#imageHolder li:nth-child(1), #imageHolder li:nth-child(3), #imageHolder li:nth-child(4), #imageHolder li:nth-child(5)" ),
		imageToHideThird: $( "#imageHolder li:nth-child(1), #imageHolder li:nth-child(2), #imageHolder li:nth-child(4), #imageHolder li:nth-child(5)" ),
		imageToHideFourth: $( "#imageHolder li:nth-child(1), #imageHolder li:nth-child(2), #imageHolder li:nth-child(3), #imageHolder li:nth-child(5)" ),
		imageToHideFifth: $( "#imageHolder li:nth-child(1), #imageHolder li:nth-child(2), #imageHolder li:nth-child(3), #imageHolder li:nth-child(4)" )
	};
	
	$(function() {
		$( "#slider" ).slider({
			value:100,
			min: 100,
			max: 500,
			step: 100,
			slide: function( event, ui ) {
				$( "#amount" ).val( ui.value );
				console.log($("#amount").val());
				
				
				if ($( "#amount" ).val() == "100") { 
					$("#imageHolder li:nth-child(1)").addClass("active");
					$("#imageHolder li:nth-child(1)").fadeIn(500);
					$("#imageHolder li:nth-child(1)").css("display", "block");
					
					dom.imageToHideFirst.removeClass("active");
					dom.imageToHideFirst.css("display","none");
					
				} else if ($( "#amount" ).val() == "200") {
					$("#imageHolder li:nth-child(2)").addClass("active");
					$("#imageHolder li:nth-child(2)").fadeIn(500);
					$("#imageHolder li:nth-child(2)").css("display", "block");
					
					dom.imageToHideSecond.removeClass("active");
					dom.imageToHideSecond.css("display","none");
					
					
				} else if ($( "#amount" ).val() == "300") {
					$("#imageHolder li:nth-child(3)").addClass("active");
					$("#imageHolder li:nth-child(3)").fadeIn(500);
					$("#imageHolder li:nth-child(3)").css("display", "block");
					
					dom.imageToHideThird.removeClass("active");
					dom.imageToHideThird.css("display","none");
					
				} else if ($( "#amount" ).val() == "400") {
					$("#imageHolder li:nth-child(4)").addClass("active");
					$("#imageHolder li:nth-child(4)").fadeIn(500);
					$("#imageHolder li:nth-child(4)").css("display", "block");
					
					dom.imageToHideFourth.removeClass("active");
					dom.imageToHideFourth.css("display","none");
					
					
				} else if ($( "#amount" ).val() == "500") {
					$("#imageHolder li:nth-child(5)").addClass("active");
					$("#imageHolder li:nth-child(5)").fadeIn(500);
					$("#imageHolder li:nth-child(5)").css("display", "block");
					
					dom.imageToHideFifth.removeClass("active");
					dom.imageToHideFifth.css("display","none");
				}
			}
		}); 
		
		$( "#amount" ).val($( "#slider" ).slider( "value" ) );
		
		
	}); 
});
</script>
</body>
</html>
