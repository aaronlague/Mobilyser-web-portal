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
  <div class="col-lg-12">
    <div class="col-lg-12 callHistoryDetails">
      <div class="row">
        <table class="table callHistoryInfo">
          <tbody>
            <tr>
              <td colspan="2">
			  	  <div class="callerInfoContainer">
				  	  <a id="returnToList"><span class="fui-arrow-left"></span></a>
					  <span class="contactName">
						<?php echo $contacthistory->getContactHistory($_GET['phoneNumberCellValue'], 'n', $connect); ?>
					  </span>
					  <input type="hidden" name="contact-number" id="contact-number" value="<?php echo $_GET['phoneNumberCellValue']; ?>" />
				  </div>
			  </td>
              <td colspan="2">
				  <div class="toggleContainer">
				  	<?php echo $contacthistory->getContactHistory($_GET['phoneNumberCellValue'], 'y', $connect); ?>
				  </div>
			  </td>
            </tr>
            <tr>
              <td class="financialYearColumn">Financial <br />
                Year to date:</td>
              <td class="totalCallsColumn"><div class="totalCallsLabel">Total calls:
                  <div class="totalCallsValue"><?php echo $historymodel->getHistoryTotals($_GET['phoneNumberCellValue'], $connect); ?></div>
                </div></td>
              <td class="totalDurationColumn">
			  	<div class="totalDurationLabel">Total duration:
                  <div class="totalDurationValue"><?php echo $historymodel->getDurationTotals($_GET['phoneNumberCellValue'], $connect); ?></div>
                </div>
			  </td>
              <td class="totalCostColumn">
			  	<div class="totalCostLabel">Total actual cost:
                  <div class="totalCostValue"><?php echo $historymodel->getTotalCost($_GET['phoneNumberCellValue'], $connect); ?></div>
                </div>
			  </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php 
echo '<h4>Call List</h4>';
echo '<table class="table table-striped table-bordered calls-history-table" id="callHistoryData">';
echo '<thead>';
echo '<tr>';
echo '<th>Date</th>';
echo '<th>Time</th>';
echo '<th>Duration</th>';
echo '<th>Estimated cost</th>';
echo '<th>Actual cost</th>';
echo '<th>Bill date</th>';
echo '</tr>';
echo '</thead>';
echo $historymodel->getHistory($_GET['phoneNumberCellValue'], $_SESSION['account_num'], $connect);
echo '</table>';
?>

<script src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="js/bootstrap-switch.js"></script>
<script src="js/application.js"></script>
<script src="js/core.js"></script>
<script src="js/call-history.js"></script>