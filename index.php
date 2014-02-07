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
<link href="css/styles.css" rel="stylesheet">
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<!--<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">-->
<nav class="navbar navbar-inverse" role="navigation">
  <div class="container">
    <div class="row">
      <div class="navbar-header col-md-5"><i class="fa fa-mobile fa-5x" style="font-size: 9em!important; float:left; color:#fff;"></i> <a class="navbar-brand" style="margin-top:30px; margin-left:0px; color:#fff;" href="index.php">Mobilyser<br />
        <span style="font-size:12px; font-weight:bold; color:#FFFFFF;">Mobile | Tracking | Analysis</span></a> </div>
      <!--login form goes here-->
      <div class="col-md-6 col-md-push-1 loginSection">
		<?php echo $formelem->create(array('method'=>'post','class'=>'form-horizontal')); ?>
          <fieldset>
            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="Email">Email</label>
              <div class="col-md-8">
				<?php echo $formelem->text(array('id'=>'email','name'=>'email','placeholder'=>'Email','class'=>'form-control input-sm '.$emailFlag['class'].'','required'=>'')); ?>
              </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="password">Password</label>
              <div class="col-md-8">
				<?php echo $formelem->password(array('id'=>'password','name'=>'password','placeholder'=>'Password','class'=>'form-control input-sm '.$pwordFlag['class'].'','required'=>'')); ?>
              </div>
            </div>
            <!-- Button -->
            <div class="form-group">
              <div class="row">
                <div class="col-md-10 col-md-push-1">
                  <div class="col-md-6 col-md-push-3">
                    <a href="forgotpassword.php">Forgot your password?</a>
                  </div>
                <div class="col-md-5 col-md-push-1"><?php echo $formelem->button(array('id'=>'btn-login','name'=>'btn-login','class'=>'btn btn-primary', 'style'=>'width:100%', 'value'=>'Login')); ?></div>
              </div>
              </div>
            </div>
          </fieldset>
		  <?php echo $formelem->close(); ?>
        <!--</form>-->
      </div>
    </div>
    <!--login form ends here-->
  </div>
  <!-- /.container -->
</nav>
<div class="section topContent">
  <div class="container">
    <h1>Need to analyse your mobile calls to claim an expense or prepare your tax return?</h1>
    <p>Mobilyser provides an efficient mechanism for scaning your mobile phone bills and matching this information to contacts you have tagged as being related to work. We can provide an accurate figure to support an employee expense claim or your tax return. </p>
    <a class="btn btn-lg btn-primary" href="register.php">Sign Up Now!</a> </div>
</div>
<div class="section">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-4" style="text-align:center;"> <img src="images/img-mobile.png" border="0" />
        <h3>Mobile</h3>
      </div>
      <div class="col-lg-4 col-md-4" style="text-align:center;"> <img src="images/img-tracking.png" border="0" />
        <h3>Tracking</h3>
      </div>
      <div class="col-lg-4 col-md-4" style="text-align:center;"> <img src="images/img-data.png" border="0" />
        <h3>Analysis</h3>
      </div>
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->
</div>
<!-- /.section -->
<div class="section">
  <div class="container">
    <div class="row">
      <div class="col-lg-7">
        <h1>Heading 1</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.</p>
      </div>
	  <div class="col-lg-4 col-lg-push-1">
	  <img src="http://placehold.it/300x300">
	  </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="row well">
    <div class="col-lg-8 col-md-8">
      <h4>Mobilyser Mobile App is a ready-to-use!</h4>
      <p>Aenean interdum eros et mauris rhoncus elementum. Nunc blandit libero non quam scelerisque, at feugiat purus tincidunt. Nulla neque nibh, blandit quis aliquam a, laoreet sed nisi. Donec porta elit id justo suscipit, sed dapibus arcu molestie.</p>
    </div>
    <div class="col-lg-4 col-md-4"> <a class="btn btn-lg btn-primary pull-right" href="register.php">Sign Up Now!</a> </div>
  </div>
  <!-- /.row -->
</div>
<!-- /.container -->
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
<script src="js/modern-business.js"></script>
</body>
</html>
