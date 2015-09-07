$(".deleterow").on("click", function(){
		var $killrow = $(this).parent('tr');
		$killrow.addClass("danger");
		$killrow.fadeOut(1000, function(){
		$(this).remove();
	});
});
