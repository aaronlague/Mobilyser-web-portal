<div class="container" style="padding-left:30px;" data-page-name="callLogsPage">
  <div class="row filterSection" id="filterControls">
    <div class="col-lg-2"><span>Filter Calls</span></div>
    <!--<div>-->
		<div class="col-lg-2" style="margin-left:-20px!important;">
  	  <div class="btn-group select select-block mbl">
  		<button class="btn dropdown-toggle clearfix btn-sm btn-warning" data-toggle="dropdown">
  		<span class="filter-option pull-left"><div id="ctype-selected">Select call type</div></span>&nbsp;<span class="caret"></span></button>
  		<span class="dropdown-arrow"></span>
      <input type="hidden" name="calltype" id="calltype" value="A" />
  		<ul class="dropdown-menu" role="menu" style="max-height: 200px; overflow-y: auto; min-height: 108px;">
  		  <li id="ctype_0" onclick="ctype_data(0, 'Select call type');" rel="A" class="ctype"><a tabindex="-1" href="#" class="opt"><span class="pull-left">Select call type</span></a></li>
  		  <li id="ctype_A" onclick="ctype_data('A', 'All calls');" rel="A" class="ctype"><a tabindex="-1" href="#" class="opt"><span class="pull-left">All calls</span></a></li>
  		  <li id="ctype_P" onclick="ctype_data('P', 'Personal');" rel="P" class="ctype"><a tabindex="-1" href="#" class="opt"><span class="pull-left">Personal</span></a></li>
  		  <li id="ctype_W" onclick="ctype_data('W', 'Work');" rel="W" class="ctype"><a tabindex="-1" href="#" class="opt"><span class="pull-left">Work</span></a></li>
  		  <li id="ctype_U" onclick="ctype_data('U', 'Untagged');" rel="U" class="ctype"><a tabindex="-1" href="#" class="opt "><span class="pull-left">Untagged</span></a></li>
  		</ul>
  	  </div>
      <?php //echo $formelem->select(array('id'=>'calltype','name'=>'calltype','class'=>'select-block mbl','data'=>$calltype_data)); ?>
	</div>
    <div class="col-lg-2" style="margin-left:-20px!important;">
        <div class="btn-group select select-block mbl">
        <button class="btn dropdown-toggle clearfix btn-sm btn-warning" data-toggle="dropdown">
        <span class="filter-option pull-left"><div id="btype-selected">Select</div></span>&nbsp;<span class="caret"></span></button>
        <span class="dropdown-arrow"></span>
        <input type="hidden" name="billtype" id="billtype" value="0" />
        <ul class="dropdown-menu" role="menu" style="max-height: 200px; overflow-y: auto; min-height: 108px;">
          <?php echo $bill_upload_data; ?>
        </ul>
        </div>
    </div>
	<!--</div>-->
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
