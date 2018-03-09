$(function(){
  //modal
  $("#open_modal").click(function(){
    $("#modal").removeClass("hidden");
    $("#mask").removeClass("hidden");
   });

  $("#close_modal").click(function(){
    $("#modal").addClass("hidden");
    $("#mask").addClass("hidden");
  });

  $("#mask").click(function(){
    $("#close_modal").click();
  });
});
