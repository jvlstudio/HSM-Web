/* JS MODELS */

$(function()
{	
	$("input[type=\"file\"]")
	.each(function(){
		var $self   = $(this);
		var $parent = $self.parent();
		var $span	= $("#"+$parent.attr("id")+" span");
		
		$span.text($parent.attr("label"));
		//$self.css("width", $parent.width());
	})
	.bind("change", function(){
		var $self   = $(this);
		var $parent = $self.parent();
		var $span	= $("#"+$parent.attr("id")+" span");
		var fileName= $self.val().split(/\\/).pop(); 
			$parent.addClass('populated');
			
			if(fileName == "")
				$span.text($parent.attr("label"));
			else
				$span.text(fileName);
	});
});