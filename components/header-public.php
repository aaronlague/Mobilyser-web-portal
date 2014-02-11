<!--login form goes here-->
<div class="loginSection col-lg-3 col-lg-offset-3">
<?php echo $formelem->create(array('method'=>'post','class'=>'form-horizontal loginFormSection')); ?>
<fieldset>
  <div class="form-group <?php echo $emailFlag['class'] ?> "><?php echo $formelem->text(array('id'=>'email','name'=>'email','placeholder'=>'Username','class'=>'form-control input-sm '.$emailFlag['class'].'', 'value'=>$email)); ?> <span class="input-icon fui-user"></span> </div>
  <div class="form-group <?php echo $pwordFlag['class'] ?>"><?php echo $formelem->password(array('id'=>'password','name'=>'password','placeholder'=>'Password','class'=>'form-control input-sm '.$pwordFlag['class'].'')); ?> <span class="input-icon fui-lock"></span> </div>
  </div>
  <div class="submitContainer col-lg-1">
    <p><a href="forgotpassword.php">Lost your password?</a></p>
    <?php echo $formelem->button(array('id'=>'btn-login','name'=>'btn-login','class'=>'btn btn-sm btn-primary btn-login', 'value'=>'Login')); ?> </div>
</fieldset>
<?php echo $formelem->close(); ?>
</div>
