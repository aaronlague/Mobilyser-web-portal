<?php
$acctno = $_SESSION['account_num'];

$telcoSql = $db->mquery("SELECT * FROM Phonenumbers WHERE accountnumber = '".$acctno."'", $connect);
$telcoCount = $db->numhasrows($telcoSql);
$telcoRow = $db->fetchobject($telcoSql);

if ($telcoCount != 0) {

	$mobileNumber = $db->strip($telcoRow->phonenumber);
	$telco = $db->strip($telcoRow->telecom);
	$connection_fee = $db->strip($telcoRow->connection_fee);
	$call_charge = $db->strip($telcoRow->call_charge);

} else {

	//do something

}

$infoSql = $db->mquery("SELECT * FROM Users WHERE acct_no = '".$acctno."'", $connect);
$infoCount = $db->numhasrows($infoSql);
$infoRow = $db->fetchobject($infoSql);

if ($infoCount != 0) {

	$firstname = $db->strip($infoRow->firstname);
	$lastname = $db->strip($infoRow->lastname);
	$email = $db->strip($infoRow->email);
	$country = $db->strip($infoRow->country);

} else {

	//do something

}

if(isset($_POST['btn-update-personal'])){

	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$curr_email = $_POST['emailaddress'];
	$country = $_POST['country'];
	
	$db->mquery("UPDATE Users SET firstname ='".$firstname."', lastname = '".$lastname."', email = '".$curr_email."', country = '".$country."' WHERE acct_no='".$acctno."'", $connect);
	
	header("Location: accounts?personalinfo_update=true");

}

if(isset($_POST['btn-update-telco'])){

	$acctno = $_SESSION['account_num'];
	$mobilenumber = $_POST['mobileNumber'];
	$telco = $_POST['telco'];
	$connectionfee = $_POST['connectionfee'];
	$callcharge = $_POST['callcharge'];
	
	$db->mquery("UPDATE Phonenumbers SET phonenumber ='".$mobilenumber."', telecom = '".$telco."', connection_fee = '".$connectionfee."', call_charge = '".$callcharge."' WHERE accountnumber='".$acctno."'", $connect);
	
	header("Location: accounts?telco_update=true");

}



?>
<?php $country_data = $lookupmodel->getCountry($connect); ?>
<!-- Modal -->
<div class="modal fade" id="modalAccount" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close fui-cross" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Account Management</h4>
      </div>
      <div class="modal-body" style="text-align:center;"> <a data-toggle="modal" data-target="#modalPersonal" class="btn btn-primary btn-lg">Personal Information</a> <a data-toggle="modal" data-target="#telcoSetupModal" class="btn btn-primary btn-lg">Telco Information</a> </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div class="modal fade" id="modalPersonal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close fui-cross" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Personal Information</h4>
      </div>
      <div class="modal-body"><?php echo $formelem->create(array('method'=>'post','class'=>'signUpFormSection form-horizontal')); ?>
        <fieldset>
        <!-- Text input-->
        <div class="form-group <?php echo $fnameFlag['class'] ?>">
          <?php	echo $fnameFlag['message']; ?>
          <label class="col-md-4 control-label" for="name">First name</label>
          <div class="col-md-12"> <?php echo $formelem->text(array('id'=>'firstname','name'=>'firstname','placeholder'=>'First name*','class'=>'form-control input-sm '.$fnameFlag['class'].'', 'value'=>$firstname)); ?></div>
        </div>
        <!-- Text input-->
        <div class="form-group <?php echo $lnameFlag['class'] ?>">
          <?php	echo $lnameFlag['message']; ?>
          <label class="col-md-4 control-label" for="name">Last name</label>
          <div class="col-md-12"> <?php echo $formelem->text(array('id'=>'lastname','name'=>'lastname','placeholder'=>'Last name*','class'=>'form-control input-sm '.$lnameFlag['class'].'', 'value'=>$lastname)); ?></div>
        </div>
        <!-- Text input-->
        <div class="form-group <?php echo $emailaddressFlag['class'] ?> "> <?php echo $emailaddressFlag['message']; ?>
          <label class="col-md-4 control-label" for="name">Email</label>
          <div class="col-md-12"> <?php echo $formelem->text(array('id'=>'emailaddress','name'=>'emailaddress','placeholder'=>'Email*','class'=>'form-control input-sm '.$emailaddressFlag['class'].'', 'value'=>$email)); ?></div>
        </div>
        <!-- Select Basic -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="name">Country</label>
          <div class="col-md-12"> <?php echo $formelem->select(array('id'=>'country','name'=>'country','class'=>'form-control input-md','data'=>$country_data, 'value'=>$country)); ?></div>
        </div>
        </fieldset>
      </div>
      <div class="modal-footer"> <a data-dismiss="modal" class="btn btn-cancel">Cancel</a> <?php echo $formelem->button(array('id'=>'btn-update-personal','name'=>'btn-update-personal','class'=>'btn btn-primary', 'value'=>'Update')); ?> </div>
      <?php echo $formelem->close(); ?> </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
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
        <div class="col-md-12"> <?php echo $formelem->text(array('id'=>'mobileNumber','name'=>'mobileNumber','placeholder'=>'Mobile number','class'=>'form-control input-sm '.$mobileFlag['class'].'', 'value'=>$mobileNumber)); ?></div>
      </div>
      <!-- Select Basic -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="Telco">Telco</label>
        <div class="col-md-12">
          <?php //echo $formelem->select(array('id'=>'telco','name'=>'telco','class'=>'form-control','data'=>$telco)); ?>
          <?php echo $formelem->text(array('id'=>'telco','name'=>'telco','placeholder'=>'Telco provider','class'=>'form-control input-sm '.$telcoFlag['class'].'', 'value'=>$telco)); ?></div>
      </div>
      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="Connection fee">Connection fee</label>
        <div class="col-md-12"> <?php echo $formelem->text(array('id'=>'connectionfee','name'=>'connectionfee','placeholder'=>'Connection fee','class'=>'form-control input-sm', 'value'=>number_format($connection_fee, 2))); ?> </div>
      </div>
      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="Per minute call charge">Per minute call charge</label>
        <div class="col-md-12"> <?php echo $formelem->text(array('id'=>'callcharge','name'=>'callcharge','placeholder'=>'Per minute call charge','class'=>'form-control input-sm', 'value'=>number_format($call_charge, 2))); ?> </div>
      </div>
      <span class="note"><strong>Please note:</strong> Due to the complex billing arrangements most Telcos have in place for international calls we are unable to estimate the cost of these calls.</span>
      </div>
      </fieldset>
      <div class="modal-footer"> <a href="#" data-dismiss="modal" class="btn btn-decline">Cancel</a> <?php echo $formelem->button(array('id'=>'btn-update-telco','name'=>'btn-update-telco','class'=>'btn btn-primary', 'value'=>'Update')); ?>
	  </div>
    </div>
    <?php echo $formelem->close(); ?>
	</div>
</div>
</div>
