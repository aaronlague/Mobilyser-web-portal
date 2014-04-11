<?php
session_start();

include '../protected/config/db_config.php';

$db = new db_config();

$connect = $db->connect();

$caller_tag = $db->escape($_POST['caller_tag']);
$phone = $db->escape($_POST['phone']);
$caller_date = $db->escape($_POST['call_date']);
$caller_time = $db->escape($_POST['call_time']);

$db->mquery("UPDATE call SET caller_tag = '".$caller_tag."' WHERE  REPLACE(phone_number, ' ', '')='".$phone."' and call_date='".$caller_date."' and time='".$caller_time."'", $connect);
//header("location: ../accounts.php?updatecalls=true");

//check data values
//echo $caller_tag;
//echo $phone;
//echo $caller_date;
//echo $caller_time;

?>