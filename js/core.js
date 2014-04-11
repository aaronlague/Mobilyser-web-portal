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
				passwordRegex: "Please choose a password containing more than 6 characters, including at least one number or special character. Example: eXpr3$$",
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

var callerTagToggle = function() {

$("input:checkbox").bootstrapSwitch();
$('.switch').on('switch-change', function (e, data) {
        var $el = $(data.el)
          , value = data.value;
		  
        if(value){//this is true if the switch is on
           console.log('Changed to Personal');
		   $(this).closest('tr').children('td.callTag').find('img.personalLabel').attr('src','images/image-personal-colored.png');
		   $(this).closest('tr').children('td.callTag').find('img.workLabel').attr('src','images/image-work-gray.png');
		   //event.preventdefault();
		   
			var phoneNumber = $(this).closest('tr').children('td.phoneNo').find("input").val();
			$.ajax({
			  url: "ajax-calls/update-call-logs.php",
			  type: "POST",
			  data: {
				  caller_tag: 'P',
				  call_date: $(this).closest('tr').children('td.callDate').find("input").val(),
				  call_time: $(this).closest('tr').children('td.callTime').text(),
				  //phone: phoneNumber.replace(/\s+/g, '')
				  phone: phoneNumber
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
		   $(this).closest('tr').children('td.callTag').find('img.personalLabel').attr('src','images/image-personal-gray.png');
		   $(this).closest('tr').children('td.callTag').find('img.workLabel').attr('src','images/image-work-colored.png');
		   //event.preventdefault();
		   
			var phoneNumber = $(this).closest('tr').children('td.phoneNo').find("input").val();
			$.ajax({
			  url: "ajax-calls/update-call-logs.php",
			  type: "POST",
			  data: {
				  caller_tag: 'W',
				  call_date: $(this).closest('tr').children('td.callDate').find("input").val(),
				  call_time: $(this).closest('tr').children('td.callTime').text(),
				  //phone: phoneNumber.replace(/\s+/g, '')
				  phone: phoneNumber
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

$(document).ready(function () {
							
	if ($('div[data-page-name]').data("pageName") == "signupPage") {
		
		createAccount();
		
	}
	
	if ($('div[data-page-name]').data("pageName") == "createPasswordPage") {
		
		createPassword();
		
	}
	
	if ($('div[data-page-name]').data("pageName") == "callLogsPage") {
		
		callerTagToggle();
		
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
				"bDestroy" : true
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
				"bDestroy" : true
			} );
		}
	}

});