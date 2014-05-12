var createAccount = function() {

$.validator.addMethod('selectcheck', function (value) {	return (value != '0');
}, "Country required");

$('#signUpFormSection').validate({

		onkeyup: false,
	    onclick: false,
	    onfocusout: false,
		
		errorElement: "li",
		errorLabelContainer: "#errorMessages ul",
		
		highlight: function(element, errorClass) {
		
			$(element).addClass(errorClass);
			$(element.form).find("label[for=" + element.id + "]").removeClass(errorClass);
			$("#errorMessages ul").css("display", "block").addClass("alert alert-danger");
			$(".btn-inverse").addClass("error");
		
		},
		
		unhighlight: function(element, errorClass) {
		
			 $(element).removeClass(errorClass);
			 $(element.form).find("label[for=" + element.id + "]").removeClass(errorClass);
			 $("#errorMessages ul").css("display", "block").addClass("alert alert-danger");
			 $(".btn-inverse").removeClass("error");
			 
		},
		
		ignore: [], //bootstrap select validation override 
		
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
			},
			country: {
				required: false
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
				}//,
//			country: {
//				required: "Please select a country"
//				}
        },
		
		submitHandler: function(form) {
            form.submit();
        }

});

}

var createPassword = function() {
	
$("#btn-create").one("click", function() {

$.validator.addMethod("passwordRegex", function(value, element, regexpr) {
	return regexpr.test(value);
}, "Regex Message");

$("#createPasswordForm").validate({
		
		
		onkeyup: false,
	    onclick: false,
	    onfocusout: false,
		
		errorElement: "li",
		errorLabelContainer: "#errorMessages ul",
		
		highlight: function(element, errorClass) {
		
			$(element).addClass(errorClass);
			$(element.form).find("label[for=" + element.id + "]").removeClass(errorClass);
			$("#errorMessages ul").css("display", "block").addClass("alert alert-danger");
		
		},
		
		unhighlight: function(element, errorClass) {
		
			 $(element).removeClass(errorClass);
			 $(element.form).find("label[for=" + element.id + "]").removeClass(errorClass);
			 $("#errorMessages ul").css("display", "block").addClass("alert alert-danger");
			 
		},
		
        rules: {
            lpassword: {
				required: true,
				minlength: 6,
				passwordRegex: /^.*(?=.{6,})(?=.*\d)(?=.*[a-z]+)(?=.*[A-Z]+)(?=.*[\W_]+).*$/g,
				equalTo: "#confirmPassword"
			},
            confirmPassword: {
				required: true,
				minlength: 6,
				passwordRegex: /^.*(?=.{6,})(?=.*\d)(?=.*[a-z]+)(?=.*[A-Z]+)(?=.*[\W_]+).*$/g
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
				passwordRegex: "Please choose a password containing more than 6 characters, including at least one number or special character. Example: eXpr3$$",
				equalTo: "The passwords you entered do not match. Please try entering your selected password again."
			}
        },
        
        submitHandler: function(form) {
            form.submit();
        }
});

});
	
}

var callerTagToggle = function() {
	
$("input:checkbox").bootstrapSwitch();
$('.switch').on('switch-change', function (e, data) {
        var $el = $(data.el)
          , value = data.value;
		  
        if(value){//this is true if the switch is on
           console.log('Changed to Personal');
		   $('.toggleContainer').find('img.personalLabel').attr('src','images/personal.png');
		   $('.toggleContainer').find('img.workLabel').attr('src','images/work-grayscale.png');
		   
			var phoneNumber = $('.callerInfoContainer').find("input").val();
			$.ajax({
			  url: "ajax-calls/update-call-logs.php",
			  type: "POST",
			  data: {
				  caller_tag: 'P',
				  phone: phoneNumber.replace(/[\s+\+]/g, '')
			  },
			  success: function(data){
				   $("#stage").html(data);
			  },
			  error:function(){
				  $("#stage").html('there is error while submit');
			  }   
			}); 
			
        }else{
           console.log('Changed to Work');
		   $('.toggleContainer').find('img.personalLabel').attr('src','images/personal-grayscale.png');
		   $('.toggleContainer').find('img.workLabel').attr('src','images/work.png');
		   
			var phoneNumber = $('.callerInfoContainer').find("input").val();
			$.ajax({
			  url: "ajax-calls/update-call-logs.php",
			  type: "POST",
			  data: {
				  caller_tag: 'W',
				  phone: phoneNumber.replace(/[\s+\+]/g, '')
			  },
			  success: function(data){
				   $("#stage").html(data);
			  },
			  error:function(){
				  $("#stage").html('there is error while submit');
			  }   
			});
			
        }
    });

}

var registerInterest = function() {
	console.log("working...");
$('#regFormSection').validate({

		onkeyup: false,
	    onclick: false,
	    onfocusout: false,
		
		errorElement: "li",
		errorLabelContainer: "#errorMessages ul",
		
		highlight: function(element, errorClass) {
		
			$(element).addClass(errorClass);
			$(element.form).find("label[for=" + element.id + "]").removeClass(errorClass);
			$("#errorMessages ul").css("display", "block").addClass("alert alert-danger");
		
		},
		
		unhighlight: function(element, errorClass) {
		
			 $(element).removeClass(errorClass);
			 $(element.form).find("label[for=" + element.id + "]").removeClass(errorClass);
			 $("#errorMessages ul").css("display", "block").addClass("alert alert-danger");
			 
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
			email: {
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
			email: {
				required: "Please enter a valid email address",
				}
        },
		
		submitHandler: function(form) {
            form.submit();
        }

});

}

var forgotPassword = function() {
	
$('#forgotPasswordFormSection').validate({

		onkeyup: false,
	    onclick: false,
	    onfocusout: false,
		
		errorElement: "li",
		errorLabelContainer: "#errorMessages ul",
		
		highlight: function(element, errorClass) {
		
			$(element).addClass(errorClass);
			$(element.form).find("label[for=" + element.id + "]").removeClass(errorClass);
			$("#errorMessages ul").css("display", "block").addClass("alert alert-danger");
		
		},
		
		unhighlight: function(element, errorClass) {
		
			 $(element).removeClass(errorClass);
			 $(element.form).find("label[for=" + element.id + "]").removeClass(errorClass);
			 $("#errorMessages ul").css("display", "block").addClass("alert alert-danger");
			 
		},
		
		rules: {
			email: {
				required: true,
				email: true
			}
        },
		
		messages: {
			email: {
				required: "Please enter a valid email address"
			}
        },
		
		submitHandler: function(form) {
            form.submit();
        }

});

}


$(document).ready(function () {
							
	if ($('div[data-page-name]').data("pageName") == "signupPage") {
		
		createAccount();
		
	}
	
	if ($('div[data-page-name]').data("pageName") == "createPasswordPage") {
		
		createPassword();
		
	}
	
	if ($('div[data-page-name]').data("pageName") == "callLogsPage") {
		
		var rowCount = $('#dvData tr').length;
		if (rowCount > 10) {
			 console.log("display pagination...");
			 $('#dvData').dataTable( {
				"sPaginationType": "full_numbers",
				"bPaginate": true,
				"bLengthChange": true,
				"bFilter": true,
				"bSort": true,
				"bInfo": true,
				"bAutoWidth": true,
				"bDestroy" : true,
				"aoColumnDefs": [
				  { "bSortable": false, "aTargets": [ 0 ] }
				]
			} );

		} else if (rowCount < 10) {
			console.log("disable pagination...");
			$('#dvData').dataTable( {
				"sPaginationType": "full_numbers",
				"bPaginate": false,
				"bLengthChange": false,
				"bFilter": false,
				"bSort": false,
				"bInfo": false,
				"bAutoWidth": false,
				"bDestroy" : true,
				"aoColumnDefs": [
				  { "bSortable": false, "aTargets": [ 0 ] }
				]
			} );
		}
	}
	
	if ($('div[data-page-name]').data("pageName") == "registerYourInterestPage") {
		
		registerInterest();
		
	}
	
	if ($('div[data-page-name]').data("pageName") == "forgotPasswordPage") {
		
		forgotPassword();
		
	}

});