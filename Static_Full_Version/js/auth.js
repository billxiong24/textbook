$(document).ready(function(){
	var width = $(window).width();
	if(width < 650){
		$(".logo").hide();
	}
	$(window).resize(function(){
		if($(this).width() > 650){
			$(".logo").show();
		}
		if($(this).width() < 650){
			$(".logo").hide();
		}	
		if($(this).width() < 500){
			$(".smaller").css("font-size", "10px");
		}
		else{

		}
	});
});