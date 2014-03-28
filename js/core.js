function signupFunction() {
	
	var dom = {
		
		registerFields: $('#firstname, #lastname'),
		emailFields: $('#email')
		
	}
	
	dom.registerFields.limitkeypress({rexp: /^[A-Za-z_-\s]+$/}); //text only
	dom.emailFields.limitkeypress({rexp: /^([A-Za-z0-9_\-\.\s])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/}); //email
	
}


$(document).ready(function () {
							
	if ($('div[data-page-name]').data("pageName") == "signupPage") {
		
		signupFunction();
	}
	
	if ($('div[data-page-name]').data("pageName") == "createPasswordPage") {
		
		
	}

});