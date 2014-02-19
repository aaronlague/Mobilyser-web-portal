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
echo '<th>Phone Number</th>';
echo '<th>Contact Name</th>';
echo '<th>Caller Tag</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';
echo $contactsModel->getContacts($_SESSION['account_num'], 'n', $connect);
echo '</tbody>';
echo '</table>';

?>

<script>
$(document).ready(function() {
	var rowCount = $('#dvData tr').length;
    $('#contactsData').dataTable( {
		"sPaginationType": "full_numbers",
        "bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": true
    } );
	
} );
</script>