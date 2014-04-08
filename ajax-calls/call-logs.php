<?php
session_start();

include '../protected/config/db_config.php';
include '../protected/models/calls.php';

$db = new db_config();
$callsmodel = new CallsModel();

$connect = $db->connect();

$data = '';

$ctype = $_GET['ctype'];
$btype = $_GET['btype'];

if($ctype != '0'){
	$data['@caller_tag'] = $ctype;
}else{
	$data['@caller_tag'] = 'A';
}

if($data != ''){
	$filterFields = $db->field_search($data, 0);
}else{
	$filterFields = '';
}
$_SESSION['call_type'] = $_GET['ctype'];

echo '<h4>Call List</h4>';
echo '<table class="table table-striped table-bordered calls-table dataTable" id="dvData">';
echo '<thead>';
echo '<tr>';
echo '<th class="callerTag"><img src="images/mobilyser-logo.png"></th>';
echo '<th class="callDate">Date</th>';
echo '<th>Time</th>';
echo '<th>Contact</th>';
echo '<th>Duration</th>';
echo '<th>Est. Cost</th>';
echo '<th>Act. Cost</th>';
echo '<th>Bill Date</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';
echo $callsmodel->getCalls($_SESSION['account_num'], $filterFields, 'n', $connect);
echo '</tbody>';
echo '</table>';
?>
<script src="js/history-table.js"></script>
<script src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="js/bootstrap-switch.js"></script>
<script src="js/application.js"></script>
<script>
$(document).ready(function() {

$("input:checkbox").bootstrapSwitch();

	var rowCount = $('#dvData tr').length;
	console.log (rowCount);
	if (rowCount > 10) {
		 console.log("display pagination...");
		 $('#dvData').dataTable( {
			"sPaginationType": "full_numbers",
			"bPaginate": true,
			"bLengthChange": true,
			"bFilter": true,
			"bSort": true,
			"bInfo": true,
			"bAutoWidth": true,
			"bDestroy" : true
    	} );
		
		
		
	} else if (rowCount < 10) {
		console.log("disable pagination...");
		$('#dvData').dataTable( {
			"sPaginationType": "full_numbers",
			"bPaginate": false,
			"bLengthChange": false,
			"bFilter": false,
			"bSort": false,
			"bInfo": false,
			"bAutoWidth": false,
			"bDestroy" : true
    	} );
		
		
	}
} );
</script>