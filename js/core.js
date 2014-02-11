$(document).ready(function () {

var dom = {
	loginBtn: $("#btn-login"),
	registerFieldsToValidate: $('#firstname, #lastname'),
	signupTextFieldsToValidate: $('#firstname, #lastname'),
	signupIntFieldsToValidate: $('#accountNumber, #mobileNumber'),
	signupFloatFieldsToValidate: $('#connectionfee, #callcharge, #plancap'),
	emailFieldsToValidate: $('#email'),
	registerBtn: $("#btn-register")
};

dom.signupTextFieldsToValidate.limitkeypress({rexp: /^[A-Za-z_-\s]+$/}); 		//text only
dom.signupIntFieldsToValidate.limitkeypress({rexp: /^[0-9]+$/}); 			//integers
dom.signupFloatFieldsToValidate.limitkeypress({rexp: /^[+]?\d*\.?\d*$/}); 	//float
dom.emailFieldsToValidate.limitkeypress({rexp: /^([A-Za-z0-9_\-\.\s])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/}); //email



$("#country :first-child").attr("value", "");
$("#country option:first").text("Select country");

});