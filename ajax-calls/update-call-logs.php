<?php
session_start();

include '../protected/config/db_config.php';

$db = new db_config();

$connect = $db->connect();

$data = '';

//$mobile = $db->escape($_POST['mobile']);
//$callerTag = $db->escape($_POST['tag']);

	
echo $_POST['caller_tag'];
?>