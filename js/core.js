var createAccount = function() {
	console.log("working...");
$('#signUpFormSection').validate({

		onkeyup: false,
	    onclick: false,
	    onfocusout: false,
		
		errorElement: "div",
		errorLabelContainer: "#errorMessages",
		
		highlight: function(element, errorClass) {
		
			$(element).addClass(errorClass);
			$(element.form).find("label[for=" + element.id + "]").removeClass(errorClass);
			$("#errorMessages").css("display", "block").addClass("alert alert-danger");
		
		},
		
		unhighlight: function(element, errorClass) {
		
			 $(element).removeClass(errorClass);
			 $(element.form).find("label[for=" + element.id + "]").removeClass(errorClass);
			 $("#errorMessages").css("display", "block").addClass("alert alert-danger");
			 
		},
		
		rules: {
			firstname: {
				required: true,
				minlength: 2
			},
			lastname: {
				required: true,
				minlength: 2
			},
			emailaddress: {
				required: true,
				email: true
			}
        },
		
		messages: {
            firstname: {
				required: "First name field is required",
				},
			lastname: {
				required: "Last name field is required",
				},
			emailaddress: {
				required: "Please enter a valid email address",
				}
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
		
		errorElement: "div",
		errorLabelContainer: "#errorMessages",
		
		highlight: function(element, errorClass) {
		
			$(element).addClass(errorClass);
			$(element.form).find("label[for=" + element.id + "]").removeClass(errorClass);
			$("#errorMessages").css("display", "block").addClass("alert alert-danger");
		
		},
		
		unhighlight: function(element, errorClass) {
		
			 $(element).removeClass(errorClass);
			 $(element.form).find("label[for=" + element.id + "]").removeClass(errorClass);
			 //$("#errorMessages").css("display", "none").removeClass("alert alert-danger");
			 $("#errorMessages").css("display", "block").addClass("alert alert-danger");
			 
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

		$(".btn-create").on("click", function() {
		
		});
	
}

$(document).ready(function () {
							
	if ($('div[data-page-name]').data("pageName") == "signupPage") {
		
		createAccount();
		
	}
	
	if ($('div[data-page-name]').data("pageName") == "createPasswordPage") {
		
		createPassword();
		
	}

});