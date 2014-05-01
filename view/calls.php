<div class="container" style="padding-left:30px;" data-page-name="callLogsPage">
  <div class="row filterSection" id="filterControls">
    <div class="col-lg-2"><span>Filter Calls</span></div>
	<div class="col-lg-2" style="margin-left:-20px!important;">
  	  <?php echo $formelem->select(array('id'=>'calltype','name'=>'calltype','class'=>'selectpicker callTypeSelect','data'=>$calltype_data, 'data-width'=>'100%', 'title'=>'Select call type')); ?>
	</div>
    <div class="col-lg-2">
        <?php echo $formelem->select(array('id'=>'billtype','name'=>'billtype','class'=>'selectpicker billTypeSelect','data'=>'', 'data-width'=>'100%', 'title'=>'Select bill')); ?>
    </div>
  </div>
  <hr style="margin-left:-15px;">
  <div class="row">
    <div class="col-lg-12 callListSection" style="padding-left:0;">
      <div class="callList" id="call-logs"></div>
      <a class="btn btn-primary export" id="btn-export" style="margin-top: 15px;" href="ajax-calls/download-csv.php"><span class="fui-export"></span> Export to file</a>
	</div>
  </div>
</div>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/jquery.ui.touch-punch.min.js"></script>
<script src="js/bootstrap-select.js"></script>
<script src="js/jquery.dataTables.js"></script>
<script src="js/calls.js"></script>
<script>
	$('.selectpicker').selectpicker({
		style: 'btn-inverse',
	});
	$('#calltype').prepend('<option value="A" selected="selected">Select call type</option>');
	$('#billtype').prepend('<option value="" selected="selected">Select bill</option>');
</script>
