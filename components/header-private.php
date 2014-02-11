    <!--logged user goes here-->
    <!--<div class="row">-->
      <div class="col-lg-5 col-lg-offset-2" style="margin-top:70px;">
	  <div class="container">
        <div class="row">
			<div class="col-lg-3">
			<p style="font-size:20px; padding-left:40px; padding-top:5px; color:#d8d8d8;"><strong style="color:#2fac66">Welcome</strong> <?php echo $_SESSION['full_name']; ?></p>
			</div>
			<div class="col-lg-2" style="font-size:12px;">
			<?php echo $formelem->create(array('method'=>'post', 'action'=>'logout.php')); ?>
			<button class="btn btn-primary btn-wide mll">Log out<span class="fui-exit"></span></button>
			<?php echo $formelem->close(); ?>
			</div>
		</div>
	  </div>
      </div>
    <!--</div>-->
    <!--logged user ends here-->