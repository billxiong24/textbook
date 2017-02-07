$(document).ready(function(){
  $("form").submit(function(e) {
    //e.preventDefault();
  });
  var speed = 150;
  var clogin = $("#content-login");
  var cregister = $("#content-register");
  
  /* display the register page */
  $("#showregister").on("click", function(e){
    //e.preventDefault();
    var newheight = cregister.height();
    $(cregister).css("display", "block");
    
    $(clogin).stop().animate({
      "left": "-880px"
    }, speed, function(){ /* callback */ });
    
    $(cregister).stop().animate({
      "left": "0px"
    }, speed, function(){ $(clogin).css("display", "none"); });
    
    $("#page").stop().animate({
      "height": newheight+"px"
    }, speed, function(){ /* callback */ });
  });
  
  /* display the login page */
  $("#showlogin").on("click", function(e){
    //e.preventDefault();
    var newheight = clogin.height();
    $(clogin).css("display", "block");
    
    $(clogin).stop().animate({
      "left": "0px"
    }, speed, function() { /* callback */ });
    $(cregister).stop().animate({
      "left": "880px"
    }, speed, function() { $(cregister).css("display", "none"); });
    
    $("#page").stop().animate({
      "height": newheight+"px"
    }, speed, function(){ /* callback */ });
  });
});