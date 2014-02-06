<?php
include 'protected/models/bills.php';
$db = new db_config();
$connect = $db->connect();
$sql = $db->mquery("EXEC getTelco @userID = '" . $_SESSION['idx'] . "'", $connect);
while($row = $db->fetchobject($sql)){
	$telco = $db->strip($row->name); // get telco for the iframe parameter
}
$billsModel = new BillsModel();
?>
<div class="container">
  <div class="row">
    <div class="col-lg-8" id="bills-history">
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>Upload Date</th>
            <th>Bill name</th>
            <th>Bill Date</th>
          </tr>
        </thead>
        <tbody>
          <?php echo $billsModel->getBills($_SESSION['account_num'], 'n', $connect); ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
	  <h4>Upload new bill</h4>      
	  <hr />
	  <iframe seamless="true" src="http://192.168.2.5/byodparser/byodparser/?MyBill.AccountNumber=<?php echo $_SESSION['account_num']; ?>&MyBill.Telco=<?php echo $telco; ?>" width="1200" height="400" style="border:0px;"></iframe>
	  <!--<iframe seamless="true" src="http://192.168.2.100/myod/mobilyser-beta/temp-files/test-tables.php" width="1200" height="300" style="border:0px;"></iframe>-->
	  </div>
  </div>
</div>