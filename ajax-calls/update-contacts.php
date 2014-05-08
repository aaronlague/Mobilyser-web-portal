<?php
session_start();

include '../protected/config/db_config.php';

$db = new db_config();
$contact_db = new db_config();

$connect = $db->connect();

$caller_tag = $db->escape($_POST['caller_tag']);
$phone = $db->escape($_POST['phone']);

$contact_db->mquery("UPDATE Contacts SET Caller_Tag = '".$caller_tag."' WHERE REPLACE(REPLACE(Phonenumber, ' ', ''),'+','')='".$phone."'", $connect);

//check data values
echo $caller_tag;
echo $phone;

?>