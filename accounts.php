<?php 
session_start();

include 'protected/config/db_config.php';
include 'protected/config/html_config.php';
include 'protected/controllers/index.php';
include 'protected/models/lookup.php';

$db = new db_config();
$formelem = new FormElem();
$lookupmodel = new LookupModel();

if(!(isset($_SESSION['sess_user_id']))){
  header("Location: logout.php");
}

$connect = $db->connect();

# call filter
$calltype_data = array(
  'A'=>'All Calls',
  'W'=>'Work',
  'P'=>'Personal',
  'U'=>'Untagged'
);
# bills filter
$billtype_data = array(
  '1'=>'Option One',
  '2'=>'Option Two',
  '3'=>'Option Three',
  '4'=>'Option Four'
);

$bill_upload_data = $lookupmodel->getBills($_SESSION['account_num'], $connect);

?>
<?php include 'components/header.php'; ?>
<div class="modal" id="myModal">
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
        <div class="form-group"> <?php echo $mobileFlag['message']; ?>
          <div class="col-md-12"> <?php echo $formelem->text(array('id'=>'mobileNumber','name'=>'mobileNumber','placeholder'=>'Mobile number','class'=>'form-control input-sm '.$mobileFlag['class'].'', 'value'=>$mobile)); ?></div>
        </div>
		<!-- Select Basic -->
        <div class="form-group">
          <div class="col-md-12"> <?php echo $formelem->select(array('id'=>'telco','name'=>'telco','class'=>'form-control','data'=>$telco)); ?></div>
        </div>        
        <!-- Text input-->
        <div class="form-group">
          <div class="col-md-12"> <?php echo $formelem->text(array('id'=>'connectionfee','name'=>'connectionfee','placeholder'=>'Connection fee','class'=>'form-control input-sm')); ?> </div>
        </div>
        <!-- Text input-->
        <div class="form-group">
          <div class="col-md-12"> <?php echo $formelem->text(array('id'=>'callcharge','name'=>'callcharge','placeholder'=>'Per minute call charge','class'=>'form-control input-sm')); ?> </div>
        </div>
        <span class="note"><strong>Please note:</strong> Due to the complex billing arrangements most Telcos have in place for international calls we are unable to estimate the cost of these calls.</span>
      </fieldset>
        </div>
        <div class="modal-footer">
          <!-- Button -->
			<div class="form-group">
			  <div class="" style="text-align:center;"><?php echo $formelem->button(array('id'=>'btn-signup','name'=>'btn-signup','class'=>'btn btn-primary registerBtn', 'value'=>'Update now')); ?>
			  <?php echo $formelem->button(array('id'=>'btn-signup','name'=>'btn-signup','class'=>'btn btn-primary registerBtn', 'value'=>'Update later')); ?>
			  </div>
			</div>
        </div>
		<?php echo $formelem->close(); ?> 
      </div>
    </div>
</div>
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
		<a data-toggle="modal" data-target="#modalTelco" class="btn btn-primary btn-lg">Telco Information</a>
		
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
          <div class="col-md-12"> <?php echo $formelem->text(array('id'=>'firstname','name'=>'firstname','placeholder'=>'First name*','class'=>'form-control input-md '.$fnameFlag['class'].'', 'value'=>$fname)); ?></div>
        </div>
        <!-- Text input-->
        <div class="form-group <?php echo $lnameFlag['class'] ?>">
          <?php	echo $lnameFlag['message']; ?>
          <div class="col-md-12"> <?php echo $formelem->text(array('id'=>'lastname','name'=>'lastname','placeholder'=>'Last name*','class'=>'form-control input-md '.$lnameFlag['class'].'', 'value'=>$lname)); ?></div>
        </div>
        <!-- Text input-->
        <div class="form-group <?php echo $emailaddressFlag['class'] ?> ">
		  <?php echo $emailaddressFlag['message']; ?>
          <div class="col-md-12"> <?php echo $formelem->text(array('id'=>'emailaddress','name'=>'emailaddress','placeholder'=>'Email*','class'=>'form-control input-md '.$emailaddressFlag['class'].'', 'value'=>$email)); ?></div>
        </div>
        <!-- Select Basic -->
        <div class="form-group">
          <div class="col-md-12"> <?php echo $formelem->select(array('id'=>'country','name'=>'country','class'=>'form-control','data'=>$country_data)); ?></div>
        </div>
      	</fieldset>
     	<?php echo $formelem->close(); ?>
	</div>
	<div class="modal-footer">
	  <button type="button" class="btn btn-default" data-dismiss="modal">Update later</button>
	  <button type="button" class="btn btn-primary">Update now</button>
	</div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="modalTelco" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
	<div class="modal-header">
	  <button type="button" class="close fui-cross" data-dismiss="modal" aria-hidden="true"></button>
	  <h4 class="modal-title">Telco Information</h4>
	</div>
	<div class="modal-body">
		
	</div>
	<div class="modal-footer">
	  <button type="button" class="btn btn-default" data-dismiss="modal">Update later</button>
	  <button type="button" class="btn btn-primary">Update now</button>
	</div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="container">
<div class="row accountsTab">
<div id="errMsg"></div>
	<div class="tabContainer col-lg-12" id="tabSection">
		<ul class="nav nav-tabs" id="myTabs">
			<li class="active"><a href="#bills" data-toggle="tab">Bills</a></li>
			<li><a href="#calls" data-toggle="tab" id="calltabs">Calls</a></li>
			<li><a href="#contacts" data-toggle="tab">Contacts</a></li>
			<li><a href="#reports" data-toggle="tab">Reports</a></li>
		</ul>
	</div>
	<div class="tab-content">
		<div class="tab-pane active" id="bills">
        	<?php include ('view/bills-framed.php'); ?>
      	</div>
		<div class="tab-pane" id="calls">
        	<?php include ('view/calls.php'); ?>
      	</div>
		<div class="tab-pane" id="contacts">
        	<?php include ('view/contacts.php'); ?>
      	</div>
		<div class="tab-pane" id="reports">
        	<?php include ('view/reports.php'); ?>
    	</div>
	</div>
</div>
</div>
<!-- /.container -->
<?php include 'components/footer.php'; ?>
<script src="js/accounts.js"></script>
<script src="js/bill-history.js"></script>
<script src="js/jquery.toggler.js"></script>
<script src="js/bootstrap.submodal.js"></script>
<script>
$(document).ready(function () {
$("#iframeContainer").load(function(){
		console.log("parser loaded...");
		loadbills();
	});
});
$('.modal').toggler();
$('.fui-cross').click(function(){
	$('#myModal').modal();
	$('#myModal').modal('hide');	
})
</script>
