      <div class="userSection col-lg-5 col-lg-offset-2">
        <div class="row">
			<div class="col-lg-7">
				<div class="dropdown" style="font-size:20px;">
				  Welcome <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $_SESSION['full_name']; ?><b class="caret"></b></a>
				  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
					<li><a data-toggle="modal" href="#modalPersonal">Personal Information</a></li>
					<li><a data-toggle="modal" href="#modalTelco">Telco Information</a></li>
				  </ul>
				</div>
			</div>
			<div class="col-lg-2" style="font-size:12px;">
			<?php echo $formelem->create(array('method'=>'post', 'action'=>'logout.php')); ?>
			<button class="btn btn-primary btn-wide mll">Log out <span class="fui-exit"></span></button>
			<?php echo $formelem->close(); ?>
			</div>
		</div>
      </div>
<script src="js/jquery-1.10.2.js"></script>