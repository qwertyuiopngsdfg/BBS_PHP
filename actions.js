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

  $("#load_more").click(function(){
    $("dd").removeClass("post_hidden");
    $("dt").removeClass("post_hidden");
    $("#load_more").addClass("post_hidden");
  });

});
