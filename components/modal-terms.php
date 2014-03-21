<div class="modal" id="modalTerms">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Terms of use</h4>
        </div>
        <div class="modal-body">
          If you use this site, you are responsible for maintaining the confidentiality of your account and password and for restricting access to your computer, and you agree to accept responsibility for all activities that occur under your account or password. Mobilyser and its associates reserve the right to refuse service, terminate accounts, remove or edit content, or cancel orders in their sole discretion.
		  <br />
		  In order to use the Mobilyser service you are required to accept the terms of use. If you have any specific concerns about the terms of user for Mobilyser please contact <a href="mailto:support@mobilyser.net">support@mobilyser.net</a>
		  <br />
		  If you use this site, you are responsible for maintaining the confidentiality of your account and password and for restricting access to your computer, and you agree to accept responsibility for all activities that occur under your account or password. Mobilyser and its associates reserve the right to refuse service, terminate accounts, remove or edit content, or cancel orders in their sole discretion.
        </div>
        <div class="modal-footer">
		  <form method="post" action="">
		  <input type="hidden" name="check_email" value="<?php echo $_POST['email']; ?>"/>
          <a href="#" data-dismiss="modal" class="btn btn-decline">Decline</a>
<?php echo $formelem->button(array('id'=>'btn-accept','name'=>'btn-accept','class'=>'btn btn-sm btn-primary btn-login', 'value'=>'Accept')); ?>			
		  </form>
        </div>
      </div>
    </div>
</div>
<div class="modal" id="modalDecline">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Terms of use</h4>
        </div>
        <div class="modal-body">
			In order to use the Mobilyser service you are required to accept the terms of use. If you have any specific concerns about the terms of user for Mobilyser please contact <a href="mailto:support@mobilyser.net">support@mobilyser.net</a>
        </div>
      </div>
    </div>
</div>