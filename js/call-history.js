$(document).ready(function(){
$("#returnToList").click(function(){
		$("#tabSection").find("ul li #calltabs").trigger("click");
		$('#call-logs').fadeOut().fadeIn(500);
});

	$("#ctype_0, #ctype_A, #ctype_P, #ctype_W, #ctype_U").click(function(event){
          if($('#calltype-only').val() == 'P'){
             $('#tag-icon').attr('src', 'images/personal.png');
          }else if($('#calltype-only').val() == 'W'){
             $('#tag-icon').attr('src', 'images/work.png');
          }else{
             $('#tag-icon').attr('src', 'images/image-untagged-tag-hp.png');     
          }
         
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
		  
		  loadcontacts();
		  
      });
});