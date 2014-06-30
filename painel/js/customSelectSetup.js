$(document).bind("ready", function(){
	// custom select
	$("select").bind("change", function(){
		var $parent = $(this).parent();
		var $span	= $parent.children().eq(1);
		var $i 		= $span.children().eq(1);
		if ($(this).val()){
			$span.addClass("done").removeClass("error");
			$i.children().eq(0).removeClass("fa-sort").addClass("fa-check");
		}
		else{
			$span.removeClass("done");
			$i.children().eq(0).removeClass("fa-check").addClass("fa-sort");
		}
	});
	$("select").customSelect();
});