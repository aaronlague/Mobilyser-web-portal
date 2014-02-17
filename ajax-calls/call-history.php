<?php 
session_start();
include '../protected/config/db_config.php';
include '../protected/config/html_config.php';
include '../protected/models/history.php';
include '../protected/models/contact-history.php';
$db = new db_config();
$historymodel = new HistoryModel();
$contacthistory = new ContactHistoryModel();

$formelem = new FormElem();

$connect = $db->connect();
$calltype_data = array(
  'W'=>'Work',
  'P'=>'Personal',
  'U'=>'Untagged'
);
?>
<div class="row">
  <div class="callHistoryDetails">
    <div class="col-lg-7"> <a id="returnToList"><span class="fui-arrow-left"></span></a> <span style="font-family: helvetica; font-size: 25px; margin-left: 5px;"> <?php echo $contacthistory->getContactHistory($_GET['phoneNumberCellValue'], 'n', $connect); ?></span> </div>
    <div class="col-lg-5">
      <div class="form-group">
        <label class="col-lg-3 col-lg-push-1 control-label">Assign to:</label>
        <?php //echo $formelem->select(array('id'=>'calltype','name'=>'calltype','class'=>'form-control','data'=>$calltype_data)); ?>
        <!--begin select-->
        <div class="col-lg-5 col-lg-push-1">
          <div class="btn-group select select-block mbl">
            <button class="btn dropdown-toggle clearfix btn-sm btn-warning" data-toggle="dropdown"> <span class="filter-option pull-left">
            <div id="ctype-selected-only">Select call type</div>
            </span>&nbsp;<span class="caret"></span></button>
            <span class="dropdown-arrow"></span>
            <input type="hidden" name="contact-number" id="contact-number" value="<?php echo $_GET['phoneNumberCellValue']; ?>" />
            <input type="hidden" name="calltype-only" id="calltype-only" value="A" />
            <ul class="dropdown-menu" role="menu" style="max-height: 200px; overflow-y: auto; min-height: 108px;">
              <li id="ctype_0" onClick="" rel="A" class="ctype"><a tabindex="-1" href="#" class="opt"><span class="pull-left">Select call type</span></a></li>
              <li id="ctype_A" onClick="ctype_data_only('A', 'All calls');" rel="A" class="ctype"><a tabindex="-1" href="#" class="opt"><span class="pull-left">All calls</span></a></li>
              <li id="ctype_P" onClick="ctype_data_only('P', 'Personal');" rel="P" class="ctype"><a tabindex="-1" href="#" class="opt"><span class="pull-left">Personal</span></a></li>
              <li id="ctype_W" onClick="ctype_data_only('W', 'Work');" rel="W" class="ctype"><a tabindex="-1" href="#" class="opt"><span class="pull-left">Work</span></a></li>
              <li id="ctype_U" onClick="ctype_data_only('U', 'Untagged');" rel="U" class="ctype"><a tabindex="-1" href="#" class="opt "><span class="pull-left">Untagged</span></a></li>
            </ul>
          </div>
        </div>
        <!--end select-->
        <!--begin submit-->
		<div class="col-lg-4 col-lg-push-1">
          <button class="btn btn-sm btn-primary" id="update-primary" data-toggle="modal" data-target=".bs-modal-sm">Update&nbsp;&nbsp;<span class="fui-check-inverted"></span></button>
        </div>
        <!--end submit-->
      </div>
    </div>
  </div>
</div>
</div>
<div class="row">
  <div class="col-lg-8" style="margin-top:15px;">
    <div class="row">
      <div class="col-lg-2"> <img src="<?php echo $contacthistory->getContactHistory($_GET['phoneNumberCellValue'], 'y', $connect); ?>" border="0" /> </div>
      <div class="col-lg-6 col-lg-pull-1" style="padding-top:5px;">
        <ul style="padding-left:0px!important; list-style:none; font-size:14px;">
          <li><strong>Total Actual Cost:</strong></li>
          <li><strong>Total Estimated Cost:</strong></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<hr />
<?php 
echo '<h4>Call History</h4>';
echo '<table class="table table-striped table-bordered calls-history-table" id="dvData">';
echo '<thead>';
echo '<tr>';
echo '<th>Date</th>';
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
	
	$("#returnToList").click(function(){
		$("#tabSection").find("ul li #calltabs").trigger("click");
		$('#call-logs').fadeOut().fadeIn(500);
	});

	$("#update-primary").click(function(event){
	      console.log("saving...");
          $.post( 
             "../mobilyser-beta/ajax-calls/tag-contacts.php",
             {
              mobile: $('#contact-number').val(),
              tag: $('#calltype-only').val()
             },
             function(data) {
                $('#stage').html(data);
             }
          );
      });

});
</script>
