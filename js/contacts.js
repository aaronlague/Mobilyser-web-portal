var loadcontacts = function() {
	var showResult = $('#contactsList').html('<img src="images/299.gif" alt="loading details" style="padding:10px 10px;" />');
	var showResult = $('#contactsList').load('ajax-calls/contacts-display.php');
	console.log("refreshing contacts...")
	return showResult;
};


$(document).ready(function () {
	loadcontacts();
});