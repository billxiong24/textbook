$('.i-checks').click(function(){
	if($(this).is(':checked')){
		var index = $('.price').index($(this).parent().parent());
		uncheckOthers(index);
		var span = $(this).parent().find("span").text();
		var nums = /[0-9]+$/;
		//THIS IS THE NUMBER U WANT TO MATCH
		var price = parseInt(span.match(nums) + "");
		
	}
})

function uncheckOthers(index){
	var list = $('.todo-list').find('.price');
	console.log(list);
	for(var i = 0; i < list.length; i++){
		if(i != index){
			$(list[i]).find('.i-checks').attr('checked', false);
		}
	}
}