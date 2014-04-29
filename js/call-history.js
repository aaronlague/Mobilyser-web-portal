$(document).ready(function(){
						   
	callerTagToggle();
	
	$('#callHistoryData').dataTable( {
		"sPaginationType": "full_numbers",
		"bPaginate": true,
		"bLengthChange": true,
		"bFilter": true,
		"bSort": false,
		"bInfo": true,
		"bAutoWidth": true,
	} );					   
							   
	$("#returnToList").click(function(){
		$("#tabSection").find("ul li #calltabs").trigger("click");
		$('#call-logs').fadeOut().fadeIn(500);
	});
	

});