<?php /*?><?php
include 'protected/config/db_config.php';

$db = new db_config();
$connect = $db->connect();
$global_account = '7050789440';
$sql = $db->mquery("EXEC dbo.getCalls @account_number =" . "'" . $global_account . "'",$connect);

echo "---------------------";

$count = 0;
while($row = $db->fetcharray($sql, SQLSRV_FETCH_ASSOC)){

echo "<pre>";
echo "<strong>Phone Number</strong><br />" . $row['phone_number'] . "<br />";
echo "<strong>Estimated Cost</strong><br />" . $row['estimated_cost'] . "<br />";
echo "<strong>Actual Cost</strong><br />" . $row['actual_cost'] . "<br />";
echo "<strong>Call Date</strong><br />" . $row['call_date'] . "<br />";
echo "<strong>Time</strong><br />" . $row['time'] . "<br />";
echo "<strong>Duration</strong><br />" . $row['duration'] . "<br />";
echo "<strong>Caller Tag</strong><br />" . $row['caller_tag'] . "<br />";
echo "</pre>";

$count++;
}
echo "---------------------<br />";

echo $count;

?><?php */?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://datatables.net/download/build/jquery.dataTables.js"></script>
<script>
    $(document).ready(function () {
		var str = "test";
        $("#submitBtn").click(function () { 
		//$("#errMsg", parent.document.body).empty();
		//$("#errMsg", parent.document.body).append($("<i class='fa fa-exclamation-triangle'></i>").append(" - " + $("#msg").val())) 
		//parent.location.reload(true);
		
		//$("#bills", parent.document.body).find("#bills-history").load('http://124.107.13.62:8080/myod/mobilyser-beta/ajax-calls/bill-history.php');
			$("#bills", parent.document.body).find("#bills-history").fadeOut(500, function(){	
				console.log(this);
				$(this).fadeIn(500);
			});
		
		});
		
    });
</script>
<input id="submitBtn" value="test" type="button"/>
<div class="testTxt"></div>

<?php

include '../protected/config/db_config.php';

$db = new db_config();
$connect = $db->connect();
		$data = '';

		$sql = $db->mquery("EXEC dbo.show_ContactName @phone_number = '09112223344'", $connect);
		while($row = $db->fetcharray($sql, SQLSRV_FETCH_ASSOC)){
			echo "<pre>";
			//echo $row['firstname'];
			print_r ($row);
			echo "</pre>";
		}
		
		//$sql = $db->mquery("EXEC dbo.getbill_upload @account_number = '7050789440'", $connect);
//		while($row = $db->fetcharray($sql, SQLSRV_FETCH_ASSOC)){
//		echo "<pre>";
//		echo date_format($row['upload_date'], 'd - m - y');
//		echo "</pre>";
//		echo "--";
//			echo "<pre>";
//			echo date_format($row[0], 'Y, m, d');
//			echo "</pre>";
//		}

		//$sql = $db->mquery("exec callchart @acct_no = '7050789440'", $connect);
//		$num = $db->numrows($sql);
//		while($row = $db->fetchobject($sql)){
//		echo "<pre>";
//			print_r ($row);
//			echo "</pre>";
//		}

		//$sql = $db->mquery("SELECT * FROM bill_upload", $connect);
//		$num = $db->numrows($sql);
//		while($row = $db->fetchobject($sql)){
//		echo "<pre>";
//			print_r ($row);
//			echo "</pre>";
//		}
		
		

?>