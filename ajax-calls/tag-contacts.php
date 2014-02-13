<?php
session_start();

include '../protected/config/db_config.php';

$db = new db_config();

$connect = $db->connect();

$data = '';

$ctype = $_GET['ctype'];
$btype = $_GET['btype'];

?>