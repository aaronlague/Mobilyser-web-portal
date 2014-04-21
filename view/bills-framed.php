<?php
$db = new db_config();
$connect = $db->connect();
$sql = $db->mquery("EXEC getTelco @userID = '" . $_SESSION['idx'] . "'", $connect);
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
	  <iframe id="iframeContainer" seamless="true" src="/byodparser/?MyBill.AccountNumber=<?php echo $_SESSION['account_num']; ?>&MyBill.Telco=<?php echo $telco; ?>" width="1250" height="800" style="border:0px;"></iframe>
	  </div>
  </div>
</div>