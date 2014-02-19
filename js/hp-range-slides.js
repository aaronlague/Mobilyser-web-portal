$(document).ready(function(){
	var dom = {
		imageToHideFirst: $( "#imageHolder li:nth-child(2), #imageHolder li:nth-child(3), #imageHolder li:nth-child(4), #imageHolder li:nth-child(5), #imageHolder li:nth-child(6)" ),
		imageToHideSecond: $( "#imageHolder li:nth-child(1), #imageHolder li:nth-child(3), #imageHolder li:nth-child(4), #imageHolder li:nth-child(5), #imageHolder li:nth-child(6)" ),
		imageToHideThird: $( "#imageHolder li:nth-child(1), #imageHolder li:nth-child(2), #imageHolder li:nth-child(4), #imageHolder li:nth-child(5), #imageHolder li:nth-child(6)" ),
		imageToHideFourth: $( "#imageHolder li:nth-child(1), #imageHolder li:nth-child(2), #imageHolder li:nth-child(3), #imageHolder li:nth-child(5), #imageHolder li:nth-child(6)" ),
		imageToHideFifth: $( "#imageHolder li:nth-child(1), #imageHolder li:nth-child(2), #imageHolder li:nth-child(3), #imageHolder li:nth-child(4), #imageHolder li:nth-child(6)" ),
		imageToHideSixth: $( "#imageHolder li:nth-child(1), #imageHolder li:nth-child(2), #imageHolder li:nth-child(3), #imageHolder li:nth-child(4), #imageHolder li:nth-child(5)" )
	};
	
	$(function() {
		$( "#slider" ).slider({
			value:10,
			min: 10,
			max: 60,
			step: 10,
			slide: function( event, ui ) {
				$( "#amount" ).val( ui.value );
				//console.log($("#amount").val());
				
				
				if ($( "#amount" ).val() == "10") { 
					$("#imageHolder li:nth-child(1)").addClass("active");
					$("#imageHolder li:nth-child(1)").fadeIn(500);
					$("#imageHolder li:nth-child(1)").css("display", "block");
					
					dom.imageToHideFirst.removeClass("active");
					dom.imageToHideFirst.css("display","none");
					
				} else if ($( "#amount" ).val() == "20") {
					$("#imageHolder li:nth-child(2)").addClass("active");
					$("#imageHolder li:nth-child(2)").fadeIn(500);
					$("#imageHolder li:nth-child(2)").css("display", "block");
					
					dom.imageToHideSecond.removeClass("active");
					dom.imageToHideSecond.css("display","none");
					
					
				} else if ($( "#amount" ).val() == "30") {
					$("#imageHolder li:nth-child(3)").addClass("active");
					$("#imageHolder li:nth-child(3)").fadeIn(500);
					$("#imageHolder li:nth-child(3)").css("display", "block");
					
					dom.imageToHideThird.removeClass("active");
					dom.imageToHideThird.css("display","none");
					
				} else if ($( "#amount" ).val() == "40") {
					$("#imageHolder li:nth-child(4)").addClass("active");
					$("#imageHolder li:nth-child(4)").fadeIn(500);
					$("#imageHolder li:nth-child(4)").css("display", "block");
					
					dom.imageToHideFourth.removeClass("active");
					dom.imageToHideFourth.css("display","none");
					
					
				} else if ($( "#amount" ).val() == "50") {
					$("#imageHolder li:nth-child(5)").addClass("active");
					$("#imageHolder li:nth-child(5)").fadeIn(500);
					$("#imageHolder li:nth-child(5)").css("display", "block");
					
					dom.imageToHideFifth.removeClass("active");
					dom.imageToHideFifth.css("display","none");
					
				} else if ($( "#amount" ).val() == "60") {
					$("#imageHolder li:nth-child(6)").addClass("active");
					$("#imageHolder li:nth-child(6)").fadeIn(500);
					$("#imageHolder li:nth-child(6)").css("display", "block");
					
					dom.imageToHideSixth.removeClass("active");
					dom.imageToHideSixth.css("display","none");
				}
			}
		}); 
		
		$( "#amount" ).val($( "#slider" ).slider( "value" ) );
		
		
	}); 
});