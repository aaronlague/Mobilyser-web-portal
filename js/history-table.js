var loadHistory = function(phoneNumberCellValue, callerTagValue){
	var returnLog = 
	        $('#call-logs').fadeOut(500 ,function() { $('#call-logs').load('ajax-calls/call-history.php?phoneNumberCellValue='+encodeURI(phoneNumberCellValue)+'&callerTagValue='+encodeURI(callerTagValue)+'').fadeIn();
			});
	return returnLog;
}


$(document).ready(function () {
	$("td.phoneNo a").on('click', function() { 
		console.log ("History Data Active");
		var strCheck = $(this).children('input#valueContainer').val().replace(/([-~!@#$%^&*()_+=`{}\[\]\|\\:;'<>,.\/? ])+/g, '');
		console.log (strCheck);
		var phoneNumberCellValue = strCheck;
		var callerTagValue = $(this).closest('tr').children('td.callTag').text(); // get the value of the call tag col related to phone number col
		loadHistory(phoneNumberCellValue, callerTagValue);
		
		$('#filterControls').hide();
		$('#filterControls').next().hide();
		
	});
});