    <!--logged user goes here-->
    <div class="row">
      <div class="col-md-5 col-xs-5 col-md-push-3" style="margin-top:50px;">
        <div class="displayContact" style="color:#FFFFFF; float:left;">
          <h3 style="font-family:Arial, Helvetica, sans-serif; font-size:15px;"><strong>Welcome</strong> <?php echo $_SESSION['full_name']; ?></h3>
        </div>
        <div class="col-md-3 col-xs-3" style="margin-top:10px">
		    <?php echo $formelem->create(array('method'=>'post', 'action'=>'logout.php')); ?>
		    <?php echo $formelem->button(array('id'=>'btn-logout','name'=>'btn-logout','class'=>'btn btn-primary','onclick'=>'submit();', 'value'=>'Sign out')); ?>
		    <?php echo $formelem->close(); ?>
        </div>
      </div>
    </div>
    <!--logged user ends here-->