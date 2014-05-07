<?php
session_start();

include 'protected/config/db_config.php';
include 'protected/config/html_config.php';
include 'protected/library/validation_library.php';
include 'protected/models/lookup.php';
include 'protected/controllers/index.php';

require("components/plugins/class.phpmailer.php");
require("components/plugins/class.smtp.php");
require("components/plugins/PHPMailerAutoload.php");
require("components/plugins/mailer.setup.php");

$db = new db_config();
$formelem = new FormElem();
$validationlib = new validationLibrary();
$lookupmodel = new LookupModel();
$indexController = new IndexController();

$connect = $db->connect();

include 'protected/config/login_config.php';

?>
<?php include 'components/header.php'; ?>
<div class="section formHeadLine">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 slideShowBlurb">
				<h1>Welcome to Mobilyser.</h1>
				<p>Highlighted below are the key components of the Mobilyser portal.  We're still refining these features, ensuring they meet the expectations of people preparing their tax returns or claiming an expense. </p>
			</div>
		</div>
		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="padding-top:45px;">
			<!-- Indicators -->
			<ol class="carousel-indicators">
			<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
			<li data-target="#carousel-example-generic" data-slide-to="1"></li>
			<li data-target="#carousel-example-generic" data-slide-to="2"></li>
			<li data-target="#carousel-example-generic" data-slide-to="3"></li>
			<li data-target="#carousel-example-generic" data-slide-to="4"></li>
			</ol>
			  
			<!-- Wrapper for slides -->
			<div class="carousel-inner">
			<div class="item active">
			<div class="itemText">
				<h1>Bills</h1>
				<p>Mobilyser allows you to create flexible report cycles, based on data from your regular telco bill. You can also upload actual billing data from your Telco to provide the actual costs for voice calls. Report cycles are designed to be aligned with your telco billing cycle, but can span any time period, providing greater flexibility in data reporting. Mobilyser accepts Telco bills in either PDF or .CSV format. </p>
			</div>
			<img src="images/carousel/image-slide-bill.png" border="0" alt="">
			</div>
			
			<div class="item">
			<div class="itemText">
				<h1>Calls</h1>
				<p>The calls section of the Mobilyser portal provides a complete list of voice calls and allows the user to allocate a tag to each number under work <img src="images/work.png" border="0" width="30" /> or personal <img src="images/personal.png" border="0" width="30" />. Within your profile you can choose to default to <img src="images/work.png" border="0" width="30"/> (all work numbers) and only change those that are personal <img src="images/personal.png" border="0" width="30" /> or vice versa, to save time tagging each number.
An estimated cost is calculated for all numbers dialled within Australia. Actual costs for each call are obtained by uploading your Telco bill, either in PDF or .CSV format.  You can sort, filter, search and export your calls to an Excel file for further analysis. </p>
			</div>
			<img src="images/carousel/image-slide-call-1.png" border="0" alt="">
			</div>
			
			<div class="item">
			<div class="itemText">
				<h1>Call detail</h1>
				<p>Clicking a specific contact name or number within the call list provides a summary of information about the number, including the total number of calls, total duration and the actual cost of these calls for the current financial year. Actual costs are calculated from the Telco bill uploaded into Mobilyser. You can export a complete list of calls to Excel for further analysis.</p>
			</div>
			<img src="images/carousel/image-slide-call-2.png" border="0" alt="">
			</div>
			
			<div class="item">
			<div class="itemText">
				<h1>Contacts</h1>
				<p>Mobilyser synchronises the contact list from your Android phone, allowing you to review and update the default tag assigned to each of your contacts. When Mobilyser first synchronises with your contact directory a default tag of either <img src="images/personal.png" border="0" width="30" /> indicating a personal contact, or <img src="images/work.png" border="0" width="30" /> to indicate a work contact is assigned to the each of your contacts. Numbers dialled outside your contact directory are also stored by Mobilyser, along with the associated default tag.</p>
			</div>
			<img src="images/carousel/image-slide-contacts.png" border="0" alt="">
			</div>
			
			<div class="item">
			<div class="itemText">
				<h1>Reports</h1>
				<p>The reports section of the Mobilyser portal provides a flexible solution for aggregating data about your device usage in order to generate a claim amount for either a tax return or an expense claim. Reports are organised by 'bill cycle'. Bill cycles are created and managed within the 'Bills' tab of the Mobilyser portal. There are multiple methods for calculating the cost of your mobile device usage. 
Mobilyser supports calculations based on call duration, call numbers and the actual cost of voice calls as per the Australian Tax Office (ATO) guidelines. You can easily switch between calculation methods within the reports screen, maximising your potential claim amount. You can also account for SMS and Data separately, allowing you to assign a higher percentage of work usage to these items, over and above the percentage of work calls calculated by Mobilyser.</p>
			</div>
			<img src="images/carousel/image-slide-reports.png" border="0" alt="">
			</div>
			
			</div>
			  
			<!-- Controls -->
			<a class="left carousel-control fui-arrow-left" href="#carousel-example-generic" data-slide="prev"></a>
			<a class="right carousel-control fui-arrow-right" href="#carousel-example-generic" data-slide="next"></a>
			  
		</div>
	</div>
</div>
<!-- /.container -->
<script src="js/jquery-1.10.2.js"></script>
<script src="js/modal-actions.js"></script>
<script src="js/core.js"></script>
<?php include 'components/footer.php'; ?>