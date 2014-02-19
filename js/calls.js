function ctype_data(elemid, elemvalue){
  var btype = $('#btype-input').val();

  $("#ctype-selected").html(elemvalue);
  $("#calltype").val(elemid);
  $(".ctype").attr("class", "ctype");
  $("#ctype_"+elemid+"").attr("class", "ctype selected");

  loadcalls(elemid, btype); 
}
function ctype_data_only(elemid, elemvalue){

  $("#ctype-selected-only").html(elemvalue);
  $("#calltype-only").val(elemid);
  $(".ctype").attr("class", "ctype");
  $("#ctype_"+elemid+"").attr("class", "ctype selected");

}
function btype_data(elemid, elemvalue){
  var ctype = $('#ctype-input').val();

  $("#btype-selected").html(elemvalue);
  $("#billtype").val(elemid);
  $(".btype").attr("class", "btype");
  $("#btype_"+elemid+"").attr("class", "btype selected");

  loadcalls(ctype, elemid); 
}