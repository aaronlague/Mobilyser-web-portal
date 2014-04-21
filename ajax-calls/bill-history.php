<?php 
session_start();
include '../protected/config/db_config.php';
include '../protected/config/html_config.php';
include '../protected/models/bills.php';
$db = new db_config();
$connect = $db->connect();

$billsModel = new BillsModel();
$formelem = new FormElem();

echo '<table class="table table-striped table-bordered">';
echo '<thead>';
echo '<tr>';
echo	'<th>Upload date</th>';
echo	'<th>Bill name</th>';
echo	'<th>Bill date</th>';
echo  '</tr>';
echo  '</thead>';
echo  '<tbody>';
echo $billsModel->getBills($_SESSION['account_num'], 'n', $connect);
echo '</tbody>';
echo '</table>';

?>