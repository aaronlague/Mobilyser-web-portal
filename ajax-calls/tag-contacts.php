<?php
session_start();

include '../protected/config/db_config.php';

$db = new db_config();

$connect = $db->connect();

$data = '';

$mobile = $db->escape($_POST['mobile']);
$ctags = $db->escape($_POST['tag']);


$db->mquery("exec update_Tag @phone_number = '".$mobile."', 
	@caller_tag = '".$ctags."'", $connect);
	
?>