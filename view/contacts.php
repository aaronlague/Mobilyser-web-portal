<?php
include 'protected/models/contacts.php';
$contactsModel = new ContactsModel();
?>
<div class="container" style="padding-left:30px;">
  <div class="row">
    <table class="table table-striped table-bordered" id="dvData">
      <thead>
        <tr>
          <th>Phone Number</th>
          <th>Contact Name</th>
          <th>Caller Tag</th>
        </tr>
      </thead>
      <tbody>
        <?php echo $contactsModel->getContacts($_SESSION['account_num'], 'n', $connect); ?>
      </tbody>
    </table>
  </div>
</div>
<script>
$(document).ready(function() {
	var rowCount = $('#dvData tr').length;
	console.log (rowCount);
	var varArgs = "true";
	console.log (varArgs);
    $('#dvData').dataTable( {
		"sPaginationType": "full_numbers",
        "bPaginate": varArgs,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": true
    } );
} );
</script>