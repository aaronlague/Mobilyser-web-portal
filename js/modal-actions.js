var showModalTerms = function(){
  $('#modalTerms').modal('show');
}

var showModalSuccess = function() {
  $('#modalSuccess').modal('show');
  setTimeout(function(){
			$('#modalSuccess').modal();
			$('#modalSuccess').modal('hide');
			window.location.replace('index.php');
		}, 5000);		
}

var showAlertSuccess = function() {
	  
	setTimeout(function(){
		$('#alertSuccess').removeClass('hideSuccessAlert');
		$('#alertSuccess').addClass('showSuccessAlert');
		//setTimeout(function(){ window.location.replace('index.php') }, 5000);
	}, 2000);
}

var showTelco = function() {
	$('#modalTelco').modal('show');
}

var passwordResetSuccess = function() {
	
	setTimeout(function(){
		$('#resetSuccess').removeClass('hideSuccessAlert');
		$('#resetSuccess').addClass('showSuccessAlert');
		//setTimeout(function(){ window.location.replace('index.php') }, 5000);
	}, 2000);
}

var passwordResetFail = function() {
	
	setTimeout(function(){
		$('#resetFail').removeClass('hideSuccessAlert');
		$('#resetFail').addClass('showSuccessAlert');
	}, 2000);
}


var tokenExpiryCreate = function() {
	
	setTimeout(function(){
		$('#tokenExpiredCreate').removeClass('hideSuccessAlert');
		$('#tokenExpiredCreate').addClass('showSuccessAlert');
	}, 2000);
}

var tokenExpiryReset = function() {
	
	setTimeout(function(){
		$('#tokenExpiredReset').removeClass('hideSuccessAlert');
		$('#tokenExpiredReset').addClass('showSuccessAlert');
	}, 2000);
}

var tokenInvalid = function() {
	
	setTimeout(function(){
		$('#tokenFail').removeClass('hideSuccessAlert');
		$('#tokenFail').addClass('showSuccessAlert');
	}, 2000);
}


$(document).ready(function() {
	$('.btn-decline').click(function(){
		$('#modalTerms').modal();
		$('#modalTerms').modal('hide');
		$('#modalDecline').modal();
		$('#modalDecline').modal('show');
		setTimeout(function(){
			$('#modalDecline').modal();
			$('#modalDecline').modal('hide');
			window.location.reload(true);
		}, 5000);
	});
});