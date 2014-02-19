$(document).ready(function(){
$("#returnToList").click(function(){
		$("#tabSection").find("ul li #calltabs").trigger("click");
		$('#call-logs').fadeOut().fadeIn(500);
	});

	$("#update-primary").click(function(event){
	      console.log("saving...");
          $.post( 
             "ajax-calls/tag-contacts.php",
             {
              mobile: $('#contact-number').val(),
              tag: $('#calltype-only').val()
             },
             function(data) {
                $('#stage').html(data);
             }
          );
      });
});