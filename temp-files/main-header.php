<?php
session_start();
session_id('myowndevice');

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
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="row">
      <div class="navbar-header col-md-5"><i class="fa fa-mobile fa-5x" style="font-size: 9em!important; float:left; color:#fff;"></i> <a class="navbar-brand" style="margin-top:30px; margin-left:0px; color:#fff;" href="index.php">Mobilyser<br />
        <span style="font-size:12px; font-weight:bold; color:#FFFFFF;">Mobile | Tracking | Analysis</span></a> </div>
      <!--login form goes here-->
      <div class="col-md-6 col-md-push-1" style="margin-top:10px; margin-left:35px;">
        <!--<form class="form-horizontal">-->
		<?php echo $formelem->create(array('method'=>'post','class'=>'form-horizontal')); ?>
          <fieldset>
            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="Email" style="color: #fff;">Email</label>
              <div class="col-md-8">
                <!--<input id="Email" name="Email" type="text" placeholder="Email" class="form-control input-sm" required="">-->
				<?php echo $formelem->text(array('id'=>'email','name'=>'email','placeholder'=>'Email','class'=>'form-control input-sm '.$emailFlag['class'].'','required'=>'')); ?>
              </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="textinput" style="color: #fff;">Password</label>
              <div class="col-md-8">
                <!--<input id="textinput" name="textinput" type="text" placeholder="Password" class="form-control input-sm" required="">-->
				<?php echo $formelem->password(array('id'=>'password','name'=>'password','placeholder'=>'Password','class'=>'form-control input-sm '.$pwordFlag['class'].'','required'=>'')); ?>
              </div>
            </div>
            <!-- Button -->
            <div class="form-group">
              <div class="row">
                <div class="col-md-7 col-md-push-4">
                  <div class="col-md-6">
                    <label class="checkbox-inline" for="-0" style="color:#FFFFFF;">
                      <input type="checkbox" name="" id="-0" value="1">
                      Remember me </label>
                  </div>
                  <div class="col-md-5 col-md-push-1">
                    <!--<button id="btn-login" name="btn-login" class="btn btn-primary" style="width:100%">Login</button>-->
					<?php echo $formelem->button(array('id'=>'btn-login','name'=>'btn-login','class'=>'btn btn-primary', 'style'=>'width:100%', 'value'=>'Login')); ?>
                  </div>
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