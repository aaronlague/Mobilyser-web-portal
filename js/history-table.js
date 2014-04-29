var loadHistory = function(phoneNumberCellValue){
	var returnLog = 
	        //$('#call-logs').fadeOut(500 ,function() { $('#call-logs').load('ajax-calls/call-history.php?phoneNumberCellValue='+encodeURI(phoneNumberCellValue)+'&callerTagValue='+encodeURI(callerTagValue)+'').fadeIn();
//			});
			$('#call-logs').fadeOut(500 ,function() { $('#call-logs').load('ajax-calls/call-history.php?phoneNumberCellValue='+encodeURI(phoneNumberCellValue)+'').fadeIn();
			});
	return returnLog;
}


$(document).ready(function () {
	$("td.phoneNo a").on('click', function() { 
		var strCheck = $(this).children('input#valueContainer').val().replace(/[_\s]/g, '');
		var phoneNumberCellValue = strCheck;
		loadHistory(phoneNumberCellValue);
		
		$('#filterControls').hide();
		$('#filterControls').next().hide();
		
	});
});