<!-- Modal -->
<div class="modal fade" id="modalAccount" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
	<div class="modal-header">
	  <button type="button" class="close fui-cross" data-dismiss="modal" aria-hidden="true"></button>
	  <h4 class="modal-title">Account Management</h4>
	</div>
	<div class="modal-body" style="text-align:center;">

		<a data-toggle="modal" data-target="#modalPersonal" class="btn btn-primary btn-lg">Personal Information</a>
		<a data-toggle="modal" data-target="#telcoSetupModal" class="btn btn-primary btn-lg">Telco Information</a>
		
	</div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="modalPersonal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
	<div class="modal-header">
	<button type="button" class="close fui-cross" data-dismiss="modal" aria-hidden="true"></button>
	  <h4 class="modal-title">Personal Information</h4>
	</div>
	<div class="modal-body">
		<?php echo $formelem->create(array('method'=>'post','class'=>'signUpFormSection form-horizontal')); ?>
      	<fieldset>
        <!-- Text input-->
        <div class="form-group <?php echo $fnameFlag['class'] ?>">
          <?php	echo $fnameFlag['message']; ?>
		  <label class="col-md-4 control-label" for="name">First name</label>
          <div class="col-md-12"> <?php echo $formelem->text(array('id'=>'firstname','name'=>'firstname','placeholder'=>'First name*','class'=>'form-control input-sm '.$fnameFlag['class'].'', 'value'=>$fname)); ?></div>
        </div>
        <!-- Text input-->
        <div class="form-group <?php echo $lnameFlag['class'] ?>">
          <?php	echo $lnameFlag['message']; ?>
		  <label class="col-md-4 control-label" for="name">Last name</label>
          <div class="col-md-12"> <?php echo $formelem->text(array('id'=>'lastname','name'=>'lastname','placeholder'=>'Last name*','class'=>'form-control input-sm '.$lnameFlag['class'].'', 'value'=>$lname)); ?></div>
        </div>
        <!-- Text input-->
        <div class="form-group <?php echo $emailaddressFlag['class'] ?> ">
		  <?php echo $emailaddressFlag['message']; ?>
		  <label class="col-md-4 control-label" for="name">Email</label>
          <div class="col-md-12"> <?php echo $formelem->text(array('id'=>'emailaddress','name'=>'emailaddress','placeholder'=>'Email*','class'=>'form-control input-sm '.$emailaddressFlag['class'].'', 'value'=>$email)); ?></div>
        </div>
        <!-- Select Basic -->		
        <div class="form-group">
		  <label class="col-md-4 control-label" for="name">Country</label>
          <div class="col-md-12"> <?php echo $formelem->select(array('id'=>'country','name'=>'country','class'=>'form-control input-md','data'=>$country_data)); ?></div>
        </div>
      	</fieldset>
     	<?php echo $formelem->close(); ?>
	</div>
	<div class="modal-footer">
	  <a data-dismiss="modal" class="btn btn-cancel">Cancel</a>
	  <button type="button" class="btn btn-primary">Update</button>
	</div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal" id="modalTelco">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
		<button type="button" class="close fui-cross" data-dismiss="modal" aria-hidden="true"></button>
          <h4 class="modal-title">Telecom Provider Information</h4>
        </div>
        <div class="modal-body">
          <?php echo $formelem->create(array('method'=>'post','class'=>'signUpFormSection form-horizontal')); ?>
      <fieldset>
        <p>Please provide some basic information about your telco plan. We use this information to calculate estimated costs for each call you make. You can provide this information later through your profile.<br />
          <br />
          Most telcos provide call cost information on their websites. Call costs vary between different mobile plans, with the same provider.</p> 
		<!-- Text input-->
        <div class="form-group">
		  <label class="col-md-4 control-label" for="Mobile number">Mobile number</label>
          <div class="col-md-12"> <?php echo $formelem->text(array('id'=>'mobileNumber','name'=>'mobileNumber','placeholder'=>'Mobile number','class'=>'form-control input-sm '.$mobileFlag['class'].'', 'value'=>$mobile)); ?></div>
        </div>
		<!-- Select Basic -->
        <div class="form-group">
		  <label class="col-md-4 control-label" for="Telco">Telco</label>
          <div class="col-md-12">
		  <?php echo $formelem->select(array('id'=>'telco','name'=>'telco','class'=>'form-control','data'=>$telco)); ?></div>
        </div>        
        <!-- Text input-->
        <div class="form-group">
		  <label class="col-md-4 control-label" for="Connection fee">Connection fee</label>
          <div class="col-md-12">
		  <?php echo $formelem->text(array('id'=>'connectionfee','name'=>'connectionfee','placeholder'=>'Connection fee','class'=>'form-control input-sm')); ?> </div>
        </div>
        <!-- Text input-->
        <div class="form-group">
		  <label class="col-md-4 control-label" for="Per minute call charge">Per minute call charge</label>
          <div class="col-md-12">
		  <?php echo $formelem->text(array('id'=>'callcharge','name'=>'callcharge','placeholder'=>'Per minute call charge','class'=>'form-control input-sm')); ?> </div>
        </div>
        <span class="note"><strong>Please note:</strong> Due to the complex billing arrangements most Telcos have in place for international calls we are unable to estimate the cost of these calls.</span>
      </fieldset>
        </div>
        <div class="modal-footer">
          <!-- Button -->
			<div class="form-group">
			  <div class="" style="">
			  <a href="#" data-dismiss="modal" class="btn btn-decline">Cancel</a>
			  <?php echo $formelem->button(array('id'=>'btn-signup','name'=>'btn-signup','class'=>'btn btn-primary', 'value'=>'Update')); ?>
			  </div>
			</div>
        </div>
		<?php echo $formelem->close(); ?> 
      </div>
    </div>
</div>