<div class="container" style="padding-left:30px;">
  <div class="row filterSection" id="filterControls">
    <h4>Filter Calls</h4>
    <div class="col-lg-2">
      <h5 class="" style="color:#666666; font-weight:bold;">Call Types</h5>
      <?php echo $formelem->select(array('id'=>'calltype','name'=>'calltype','class'=>'form-control','data'=>$calltype_data)); ?> </div>
    <div class="col-lg-4">
      <div class="col-md-6 col-md-pull-1">
        <h5 class="" style="color:#666666; font-weight:bold;">Bills</h5>
        <?php echo $formelem->select(array('id'=>'billtype','name'=>'billtype','class'=>'form-control','data'=>$bill_upload_data)); ?> </div>
    </div>
  </div>
  <hr style="margin-left:-15px;">
  <div class="row">
    <div class="col-lg-12 callListSection" style="padding-left:0;">
      <div class="callList" id="call-logs"></div>
      <a href="#" class="btn btn-primary export" id="btn-export" style="margin-top: 15px;">Export to file</a> </div>
  </div>
</div>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/export-to-csv.js"></script>
<script src="js/jquery.dataTables.js"></script>
