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
echo '<th class="callerTag">Tag</th>';
echo '<th class="callDate">Date</th>';
echo '<th class="callTime">Time</th>';
echo '<th class="contact">Contact</th>';
echo '<th class="duration">Duration</th>';
echo '<th class="estCost">Est. cost</th>';
echo '<th class="actCost">Act. cost</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';
echo $callsmodel->getCalls($_SESSION['account_num'], $filterFields, 'n', $connect);
echo '</tbody>';
echo '</table>';
?>
<script src="js/history-table.js"></script>
<script src="js/core.js"></script>