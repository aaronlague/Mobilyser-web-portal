<?php
session_start();
include '../protected/config/db_config.php';
include '../protected/config/html_config.php';
include '../protected/models/contacts.php';
$db = new db_config();
$connect = $db->connect();
$contactsModel = new ContactsModel();

echo '<table class="table table-striped table-bordered" id="contactsData">';
echo '<thead>';
echo '<tr>';
echo '<th>Caller tag</th>';
echo '<th>Contact name</th>';
echo '<th>Phone number</th>';
echo '<th>Contact origin</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';
echo $contactsModel->getContacts($_SESSION['account_num'], 'n', $connect);
echo '</tbody>';
echo '</table>';

?>
<script src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="js/bootstrap-switch.js"></script>
<script src="js/application.js"></script>
<script>
$(document).ready(function(){
$("input:checkbox").bootstrapSwitch();

$('.switch').on('switch-change', function (e, data) {

	var $el = $(data.el), value = data.value;
	  
	if(value){
		console.log('changed to personal');
		$(this).closest('tr').children('td.contactTag').find('img.workLabel').attr('src','images/work-grayscale.png');
		$(this).closest('tr').children('td.contactTag').find('img.personalLabel').attr('src','images/personal.png');
		
		var phoneNumber = $(this).closest('tr').children('td.phoneNumber').text();
			$.ajax({
				  url: "ajax-calls/update-call-logs.php",
				  type: "POST",
				  data: {
					  caller_tag: 'P',
					  phone: phoneNumber.replace(/[\s+\+]/g, '')
				  },
			  success: function(data){
					   $("#stage").html(data);
				  },
			  error:function(){
					  $("#stage").html('there is error while submit');
				  }   
			}); 
		
	} else {
		console.log('changed to work');
		$(this).closest('tr').children('td.contactTag').find('img.personalLabel').attr('src','images/personal-grayscale.png');
		$(this).closest('tr').children('td.contactTag').find('img.workLabel').attr('src','images/work.png');
		
		var phoneNumber = $(this).closest('tr').children('td.phoneNumber').text();
			$.ajax({
				  url: "ajax-calls/update-call-logs.php",
				  type: "POST",
				  data: {
					  caller_tag: 'W',
					  phone: phoneNumber.replace(/[\s+\+]/g, '')
				  },
			  success: function(data){
					   $("#stage").html(data);
				  },
			  error:function(){
					  $("#stage").html('there is error while submit');
				  }   
			});
	}

});

$('#contactsData').dataTable( {
	"sPaginationType": "full_numbers",
	"bPaginate": true,
	"bLengthChange": true,
	"bFilter": true,
	"bSort": true,
	"bInfo": true,
	"bAutoWidth": true,
	"aoColumnDefs": [
	  { "bSortable": false, "aTargets": [ 0 ] }
	]
});
});
</script>