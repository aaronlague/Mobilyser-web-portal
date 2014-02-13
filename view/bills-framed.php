<?php
$db = new db_config();
$connect = $db->connect();
$sql = $db->mquery("EXEC getTelco @userID = '" . $_SESSION['idx'] . "'", $connect);
//$sql = $db->mquery("EXEC getTelco @accountnumber = '" . $_SESSION['account_num'] . "'", $connect);
while($row = $db->fetchobject($sql)){
	$telco = $db->strip($row->name); // get telco for the iframe parameter
}
?>
<div class="container">
  <div class="row">
    <div class="col-lg-12" id="bills-history">
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
	  <h4>Upload new bill</h4>      
	  <hr />
	  <iframe seamless="true" src="http://192.168.2.5/byodparser/byodparser/?MyBill.AccountNumber=<?php echo $_SESSION['account_num']; ?>&MyBill.Telco=<?php echo $telco; ?>" width="1250" height="800" style="border:0px;"></iframe>
	  <!--<iframe seamless="true" src="http://124.107.13.62:8080/myod/mobilyser-beta/temp-files/test-tables.php" width="1250" height="800" style="border:0px;"></iframe>-->
	  </div>
  </div>
</div>