<?php 
session_start();

include 'protected/config/db_config.php';
include 'protected/config/html_config.php';
include 'protected/controllers/index.php';
include 'protected/models/lookup.php';

$db = new db_config();
$formelem = new FormElem();
$lookupmodel = new LookupModel();

if(!(isset($_SESSION['sess_user_id']))){
  header("Location: logout.php");
}

$connect = $db->connect();

# call filter
$calltype_data = array(
  'A'=>'All Calls',
  'W'=>'Work',
  'P'=>'Personal',
  'U'=>'Untagged'
);
# bills filter
$billtype_data = array(
  '1'=>'Option One',
  '2'=>'Option Two',
  '3'=>'Option Three',
  '4'=>'Option Four'
);

$bill_upload_data = $lookupmodel->getBills($_SESSION['account_num'], $connect);

?>
<?php include 'components/header.php'; ?>

<div class="container">
<div class="row accountsTab">
<div id="errMsg"></div>
	<div class="tabContainer col-lg-12" id="tabSection">
		<ul class="nav nav-tabs" id="myTabs">
			<li class="active"><a href="#bills" data-toggle="tab">Bills</a></li>
			<li><a href="#calls" data-toggle="tab" id="calltabs">Calls</a></li>
			<li><a href="#contacts" data-toggle="tab">Contacts</a></li>
			<li><a href="#reports" data-toggle="tab">Reports</a></li>
			<!--<li><a href="#generator" data-toggle="tab">Generator</a></li>-->
		</ul>
	</div>
	<div class="tab-content">
		<!--<div class="tab-pane" id="generator">
        	<?php //include ('../mobilyser-beta/view/generator.php'); ?>
    	</div>-->
		<div class="tab-pane" id="generator">
        	<?php include ('../mobilyser-beta/view/generator-x.php'); ?>
    	</div>
		<div class="tab-pane active" id="bills">
        	<?php include ('../mobilyser-beta/view/bills-framed.php'); ?>
      	</div>
		<div class="tab-pane" id="calls">
        	<?php include ('../mobilyser-beta/view/calls.php'); ?>
      	</div>
		<div class="tab-pane" id="contacts">
        	<?php include ('../mobilyser-beta/view/contacts.php'); ?>
      	</div>
		<div class="tab-pane" id="reports">
        	<?php include ('../mobilyser-beta/view/reports.php'); ?>
    	</div>
	</div>
</div>
</div>
<!-- /.container -->
<?php include 'components/footer.php'; ?>
<script src="js/accounts.js"></script>
<script src="js/bill-history.js"></script>
<script>
$(document).ready(function () {
console.log("Bills tab active");
$("ul li.active").click(function () { console.log("Bills tab active") });
$("ul li #calltabs").click(function () { console.log(" calls tab active") });


$("#iframeContainer").load(function(){
		console.log("iframe loaded...");
		loadbills();
	});

});
</script>
