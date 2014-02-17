<?php
session_start();

include '../protected/config/db_config.php';
include '../protected/models/calls.php';

$db = new db_config();
$callsmodel = new CallsModel();

$connect = $db->connect();

$callsmodel->generateCSVData($_SESSION['account_num'],$connect);

?>