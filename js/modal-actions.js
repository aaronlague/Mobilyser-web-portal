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
				setTimeout(function(){ window.location.replace('index.php') }, 5000);
			}, 2000);
}

var showTelco = function() {
	$('#modalTelco').modal('show');
}

var passwordResetSuccess = function() {
	setTimeout(function(){
		$('#resetSuccess').removeClass('hideSuccessAlert');
		$('#resetSuccess').addClass('showSuccessAlert');
	setTimeout(function(){ window.location.replace('index.php') }, 5000);
			}, 2000);
				
}

var passwordResetFail = function() {
	
	$('#resetFail').removeClass('hideSuccessAlert');
	$('#resetFail').addClass('showSuccessAlert');
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