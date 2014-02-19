var loadbills = function() {
	var showResult = $('#bills-history').html('<img src="images/299.gif" alt="loading details" style="padding:10px 10px;" />');
	var showResult = $('#bills-history').load('ajax-calls/bill-history.php');
	return showResult;
};


$(document).ready(function () {
loadbills();
});