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

$passwordFlag['class'] = '';
$cpasswordFlag['class'] = '';

$emailValue = $_GET['email'];
$verificationCode = $_GET['verification'];

$expiry = 86400; // 1 day measured in seconds = 60 seconds * 60 minutes * 24 hours
$token = $_GET['token'];
$curr_date = $_SERVER['REQUEST_TIME'];
$date_registered = $indexController->checkLinkExpiry($_GET['email'], $token, $connect);

if ($date_registered == NULL) { 

	header("Location: index.php?invalidtoken=true");

} else {

	if ($curr_date - $date_registered > $expiry) {
	
		if ($_GET['reset'] == 'false') {
			
			header("Location: index.php?tokenexpired=true&reset=false");
			
		} else if ($_GET['reset'] == 'true'){
			
			header("Location: index.php?tokenexpired=true&reset=true");
		}
	
	} else {
	
		//echo "url still valid";
		if(isset($_POST['btn-create'])){
	
		//$passwordFlag = $validationlib->isEmpty($_POST['lpassword'], 'Password', 2);
//		$cpasswordFlag = $validationlib->isEmpty($_POST['confirmPassword'], 'Confirm password', 2);
//		
//			if($_GET['reset'] == 'false') {
//			
//				if($passwordFlag['message'] == "" and $cpasswordFlag['message'] == ""){
//			
//					$indexController->createUserPassword($emailValue, $verificationCode, $_POST['lpassword'], $connect);
//			
//				}
//			
//			} else if($_GET['reset'] == 'true') {
//				
//				if($passwordFlag['message'] == "" and $cpasswordFlag['message'] == ""){
//			
//					$indexController->resetUserPassword($emailValue, $verificationCode, $_POST['lpassword'], $connect);
//			
//				}
//			
//			}
		
		}
	
	}

}

?>
<?php include 'components/header.php'; ?>
<?php include 'components/modal-alerts.php'; ?>
<div class="section formHeadLine" data-page-name="createPasswordPage">
  <div class="container">
    <div class="row">
      <div>
        <h3>Create your password</h3>
      </div>
    </div>
  </div>
</div>
<div class="createPasswordContainer container">
  <div class="row">
    <div class="createPasswordSection col-lg-10 col-lg-offset-1">
      <h4>Password details</h4>
      <p>Please choose a password containing more than 6 characters, including at least one number or special character. Example: eXpr3$$</p>
      <div class="row">
        <div class="noteTxt"> <span><strong>Mandatory field</strong></span><sup><i class="fa fa-asterisk"></i></sup> </div>
		
      </div>
	  <div class="warningContainer"></div>
	  <div id="errorMessages"></div>
      <?php echo $formelem->create(array('method'=>'post','class'=>'form-horizontal', 'id'=>'createPasswordForm')); ?>
      <fieldset>
      <!-- Text input-->
      <div class="form-group <?php echo $passwordFlag['class'] ?>"> <?php echo $passwordFlag['message']; ?>
        <div class="col-md-12"><?php echo $formelem->password(array('id'=>'password','name'=>'lpassword','placeholder'=>'Password*','class'=>'form-control input-md '.$checkPasswordFlag['class'].'', 'value'=>$password)); ?></div>
      </div>
      <!-- Text input-->
      <div class="form-group <?php echo $cpasswordFlag['class']; ?>"> <?php echo $cpasswordFlag['message']; ?>
        <div class="col-md-12"><?php echo $formelem->password(array('id'=>'confirmPassword','name'=>'confirmPassword','placeholder'=>'Confirm password*','class'=>'form-control input-md '.$reTypePasswordFlag['class'].'', 'value'=>$rePassword)); ?></div>
      </div>
      <!-- Button -->
      <div class="submitContainer form-group">
        <div class="col-md-12"> <?php echo $formelem->button(array('id'=>'btn-create','name'=>'btn-create','class'=>'btn btn-primary btn-create', 'value'=>'Create password')); ?> </div>
      </div>
      </fieldset>
      <?php echo $formelem->close(); ?> </div>
  </div>
</div>
<!-- /.container -->
<script src="js/jquery-1.10.2.js"></script>
<script src="js/jquery.validate.js"></script>
<?php include 'components/footer.php'; ?>
<script src="js/modal-actions.js"></script>
<script src="js/core.js"></script>
<script>
$(document).ready(function(){

		//if($('.form-group').hasClass('has-error')){
//			
//			var alertMessage = '<a href="#" class="close" data-dismiss="alert">&times;</a><strong>Warning!</strong><span> Please check the errors below</span>';
//			
//			$('.createPasswordSection').find('.warningContainer').addClass('alert alert-error').append(alertMessage);
//			$('[data-dismiss]').on('click', function(){
//				$('.form-group').removeClass('has-error');
//				$('span.errorMsg').remove();
//			})
//			
//		} else {
//			// do something
//		}

var alertMessage = '<a href="#" class="close" data-dismiss="alert">&times;</a><strong>Warning!</strong><span> Please check the errors below</span>';

$('.btn-create').on('click', function() {
	$('#errorMessages').find('div').addClass('check')
});

$.validator.addMethod("passwordRegex", function(value, element, regexpr) {
        return regexpr.test(value);
}, "Regex Message");

$("#createPasswordForm").validate({
		
		errorLabelContainer: '#errorMessages',
		//wrapper: 'li',
		errorClass: "alert alert-danger",
		errorElement: "div",
		//errorPlacement: function(error, element) {
        	//error.appendTo("div#errorMessages");
        //},
		
		highlight: function(element, errorClass) {
		
			$(element).addClass(errorClass);
			$(element.form).find("label[for=" + element.id + "]").removeClass(errorClass);
		
		},
		
		unhighlight: function(element, errorClass) {
		
			 $(element).removeClass(errorClass);
			 $(element.form).find("label[for=" + element.id + "]").removeClass(errorClass);
			 
		},
		
        // Specify the validation rules
        rules: {
            lpassword: {
				required: true,
				minlength: 6,
				passwordRegex: /^(?=.{6,})(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=]{1,2}).*$/
			},
            confirmPassword: {
				required: true,
				minlength: 6,
				passwordRegex: /^(?=.{6,})(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=]{1,2}).*$/
			}
        },
        
        // Specify the validation error messages
        messages: {
            lpassword: {
				required: "Please enter a password",
				passwordRegex: "Please choose a password containing more than 6 characters, including at least one number or special character. Example: eXpr3$$"
			},
            confirmPassword: {
				required: "Please confirm password",
				passwordRegex: "Password confirmation should contain more than 6 characters, including at least one number or special character. Example: eXpr3$$"
			}
        },
        
        submitHandler: function(form) {
            form.submit();
        }
	});

});
</script>