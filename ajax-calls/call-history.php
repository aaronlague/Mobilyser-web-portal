<?php 
session_start();
include '../protected/config/db_config.php';
include '../protected/config/html_config.php';
include '../protected/models/history.php';
$db = new db_config();
$historymodel = new HistoryModel();
$formelem = new FormElem();

$connect = $db->connect();
$calltype_data = array(
  'W'=>'Work',
  'P'=>'Personal',
  'U'=>'Untagged'
);
?>

<div class="row">
<div class="callHistoryDetails" style="">
  <div class="col-lg-7"><a id="callList"><i class="fa fa-chevron-circle-left fa-2x"></i></a><span style="font-family: helvetica; font-size: 25px; margin-left: 5px;">Tait Brown</span>
  </div>
  <div class="col-lg-5">
    <div class="form-group">
      <label class="col-md-3 col-md-push-4 control-label">Assign to:</label>
      <div class="col-lg-5 col-lg-push-4"><?php echo $formelem->select(array('id'=>'calltype','name'=>'calltype','class'=>'form-control','data'=>$calltype_data)); ?> </div>
    </div>
  </div>
</div>
</div>
<div class="row">
  <div class="col-lg-3" style="margin-top:15px;">
    <span class="circle"><h1 style="margin-top: 0px; padding-top:5px;"><?php echo $_GET['callerTagValue'] ?></h1></span>
	 <ul style="float:right; padding-left:0px!important; padding-right: 40px; list-style:none;">
		<li><strong>Total Actual Cost:</strong></li>
		<li><strong>Total Estimated Cost:</strong></li>
	</ul>
  </div>
</div>
<hr />
<?php 
echo '<h4>Call History</h4>';
echo '<table class="table table-striped table-bordered calls-history-table" id="dvData">';
echo '<thead>';
echo '<tr>';
echo '<th>Call Date</th>';
echo '<th>Time</th>';
echo '<th>Duration</th>';
echo '<th>Estimated Cost</th>';
echo '<th>Actual Cost</th>';
echo '<th>Bill Date</th>';
echo '</tr>';
echo '</thead>';
echo $historymodel->getHistory($_GET['phoneNumberCellValue'], $_SESSION['account_num'], $connect);
echo '</table>';

?>
<script>
$(document).ready(function(){
	var rowCount = $('#dvData tr').length;
	console.log (rowCount);
	if (rowCount <= 10) {
		
		 $('#dvData').dataTable( {
			"sPaginationType": "full_numbers",
			"bPaginate": false,
			"bLengthChange": false,
			"bFilter": false,
			"bSort": false,
			"bInfo": false,
			"bAutoWidth": false
    	} );
		
	} else {
	
		$('#dvData').dataTable( {
			"sPaginationType": "full_numbers",
			"bPaginate": true,
			"bLengthChange": true,
			"bFilter": true,
			"bSort": true,
			"bInfo": true,
			"bAutoWidth": true
    	} );
	
	}
	
	$("#callList").click(function(){
		$("#tabSection").find("ul li #calltabs").trigger("click");
		$('#call-logs').fadeOut().fadeIn(500);
	});
	
});
</script>
