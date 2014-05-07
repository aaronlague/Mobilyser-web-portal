<?php
session_start();
include '../protected/config/db_config.php';
include '../protected/config/html_config.php';
include '../protected/models/contacts.php';
$db = new db_config();
$connect = $db->connect();
$contactsModel = new ContactsModel();

echo '<table class="table table-striped table-bordered" id="contactsData">';
echo '<thead>';
echo '<tr>';
echo '<th>Caller tag</th>';
echo '<th>Contact name</th>';
echo '<th>Phone number</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';
echo $contactsModel->getContacts($_SESSION['account_num'], 'n', $connect);
echo '</tbody>';
echo '</table>';

?>
<script src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="js/bootstrap-switch.js"></script>
<script src="js/application.js"></script>
<script>
$(document).ready(function(){
$('#contactsData').dataTable( {
	"sPaginationType": "full_numbers",
	"bPaginate": true,
	"bLengthChange": true,
	"bFilter": true,
	"bSort": true,
	"bInfo": true,
	"bAutoWidth": true
});
});
</script>