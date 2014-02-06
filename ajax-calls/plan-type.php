<?php
session_start();

include '../protected/config/db_config.php';
include '../protected/config/html_config.php';
include '../protected/models/lookup.php';

$db = new db_config();
$formelem = new FormElem();
$lookupmodel = new LookupModel();

$connect = $db->connect();
$plannameId = $db->escape($_GET['id']);

echo $lookupmodel->getPlanType($plannameId, 1, $connect);
?>