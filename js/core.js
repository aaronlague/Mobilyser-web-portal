var createAccount = function() {
	
$('#signUpFormSection').validate({

		errorClass: "alert alert-danger",
		errorElement: "div",
		errorPlacement: function(error, element) {
        	error.appendTo("div#errorMessages");
        },
		
		highlight: function(element, errorClass) {
		
			$(element).addClass(errorClass);
			$(element.form).find("label[for=" + element.id + "]").removeClass(errorClass);
		
		},
		
		unhighlight: function(element, errorClass) {
		
			 $(element).removeClass(errorClass);
			 $(element.form).find("label[for=" + element.id + "]").removeClass(errorClass);
			 
		},
		
		rules: {
			firstname: {},
			lastname: {},
			emailaddress: {}
        },
		
		messages: {
            firstname: {},
			lastname: {},
			emailaddress: {}
        },
		
		submitHandler: function(form) {
            form.submit();
        }

});

}

var createPassword = function() {
	
$.validator.addMethod("passwordRegex", function(value, element, regexpr) {
	return regexpr.test(value);
}, "Regex Message");

$("#createPasswordForm").validate({
		
		onkeyup: false,
	    onclick: false,
	    onfocusout: false,
		
		errorClass: "alert alert-danger",
		errorElement: "div",
		errorPlacement: function(error, element) {
			
        	error.appendTo("div#errorMessages");
			
			if (element.attr("name") == "lpassword" || element.attr("name") == "confirmPassword" ) {
			  error.appendTo("div#errorMessages");
			} else {
			  error.insertAfter(element);
			}
			
        },
		
		highlight: function(element, errorClass) {
		
			$(element).addClass(errorClass);
			$(element.form).find("label[for=" + element.id + "]").removeClass(errorClass);
		
		},
		
		unhighlight: function(element, errorClass) {
		
			 $(element).removeClass(errorClass);
			 $(element.form).find("label[for=" + element.id + "]").removeClass(errorClass);
			 
		},
		
		groups: {
			userpassword: "lpassword confirmPassword"
		},
		
        rules: {
            lpassword: {
				required: true,
				minlength: 6,
				passwordRegex: /^(?=.{6,})(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=]{1,2}).*$/,
				equalTo: "#confirmPassword"
			},
            confirmPassword: {
				required: true,
				minlength: 6,
				passwordRegex: /^(?=.{6,})(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=]{1,2}).*$/
				//,equalTo: "#password"
			}
        },
        
        messages: {
            lpassword: {
				required: "Please enter a password",
				passwordRegex: "Please choose a password containing more than 6 characters, including at least one number or special character. Example: eXpr3$$",
				equalTo: "The passwords you entered do not match. Please try entering your selected password again."
			},
            confirmPassword: {
				required: "Please confirm password",
				passwordRegex: "Password confirmation should contain more than 6 characters, including at least one number or special character. Example: eXpr3$$",
				equalTo: "The passwords you entered do not match. Please try entering your selected password again."
			}
        },
        
        submitHandler: function(form) {
            form.submit();
        }
});
	
}

$(document).ready(function () {
							
	if ($('div[data-page-name]').data("pageName") == "signupPage") {
		
	}
	
	if ($('div[data-page-name]').data("pageName") == "createPasswordPage") {
		
		createPassword();
		
	}

});