$('.price label .i-checks').click(function(){
	if($(this).is(':checked')){
		var index = $('.price').index($(this).parent().parent());
		uncheckOthers(index, 'price');

		//this is the price u want to do stuff with
		var price = "Any";
		var span;
		if((span = $(this).parent().find("span").text()) !== "Any"){
			var nums = /[0-9]+$/;
			price = parseInt(span.match(nums) + "");
		}
		//price is a number, either 5, 10, 20, 30, or Any
		//DO STUFF HERE with price
	}
});

$('.cond label .i-checks').click(function(){
	if($(this).is(':checked')){
		var index = $('.cond').index($(this).parent().parent());
		uncheckOthers(index, 'cond');
		
		//THIS IS THE CONDITION NAME, I.E. NEW, GOOD, FAIR, POOR
		var condition = $(this).parent().find("span").text();

		//condition is a string, either New, Good, Fair, or Any
		//DO STUFF HERE with condition
		
	}
});

function uncheckOthers(index, name){
	var list = $('.todo-list').find('.'+ name);
	for(var i = 0; i < list.length; i++){
		if(i != index){
			$(list[i]).find('.i-checks').attr('checked', false);
		}
	}
}