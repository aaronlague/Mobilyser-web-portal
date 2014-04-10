var loadcalls = function(ctype, btype){
	var returnResult = $('#call-logs').html('<img src="images/299.gif" alt="loading details" style="padding:10px 10px;" />');	
	var returnResult = $('#call-logs').load('ajax-calls/call-logs.php?ctype='+encodeURI(ctype)+'&btype='+encodeURI(btype)+'');	
	return returnResult;
};

$(document).ready(function(){
	$('#myTabs a').click(function (e) {
	e.preventDefault();
  	$("#errMsg").empty();
	var url = $(this).attr("data-url");
  	var href = this.hash;
  	var pane = $(this);
	
		$(href).load(url,function(result){      
			pane.tab('show');
		});
	});
	// load first tab content
	//$('#bills').load($('.active a').attr("data-url"),function(result){
//	  $('.active a').tab('show');
//	});
	$('#contacts').load($('.active a').attr("data-url"),function(result){
	  $('.active a').tab('show');
	});
	
	//call tab ajax filter function 
 	$("#calltabs").click(function(){
		var ctype = $('#calltype').val();			
		var btype = $('#billtype').val();			
 		loadcalls(ctype, btype);
		$('#filterControls').show();
		$('#filterControls').next().show();
 	});
	
 	$("#calltype").change(function(elemid){
		var ctype = $('#calltype').val();			
		var btype = $('#billtype').val();			
 		loadcalls(ctype, btype);
 	});
});
