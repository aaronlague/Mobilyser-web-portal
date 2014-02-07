      <!--login form goes here-->
      <div class="col-md-6 col-md-push-1" style="margin-top:10px; margin-left:35px;">
        <?php echo $formelem->create(array('method'=>'post','class'=>'form-horizontal')); ?>
        <fieldset>
          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-3 control-label" for="Email" style="color: #fff;">Email</label>
            <div class="col-md-8">
              <?php echo $formelem->text(array('id'=>'email','name'=>'email','placeholder'=>'Email','class'=>'form-control input-sm '.$emailFlag['class'].'','required'=>'')); ?> </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="textinput" style="color: #fff;">Password</label>
              <div class="col-md-8"><?php echo $formelem->password(array('id'=>'password','name'=>'password','placeholder'=>'Password','class'=>'form-control input-sm '.$pwordFlag['class'].'','required'=>'')); ?> </div>
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
      </div>
    </div>