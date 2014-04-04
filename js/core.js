var createPassword = function() {
	
$.validator.addMethod("passwordRegex", function(value, element, regexpr) {
	return regexpr.test(value);
}, "Regex Message");

$("#createPasswordForm").validate({
		
		//errorLabelContainer: '#errorMessages',
		//wrapper: 'li',
		errorClass: "alert alert-danger",
		errorElement: "div",
		errorPlacement: function(error, element) {
			//error.append('<a href="#" class="close" data-dismiss="alert">&times;</a>');
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
			}
        },
        
        messages: {
            lpassword: {
				required: "Please enter a password",
				passwordRegex: "Please choose a password containing more than 6 characters, including at least one number or special character. Example: eXpr3$$",
				equalTo: "Passwords should match"
			},
            confirmPassword: {
				required: "Please confirm password",
				passwordRegex: "Password confirmation should contain more than 6 characters, including at least one number or special character. Example: eXpr3$$",
				equalTo: "Passwords should match"
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