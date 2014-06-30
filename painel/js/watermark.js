/* JS MODELS */

$(function()
{	
	/* watermark */
	var w = "watermark", f = "focus", d = "done", n = "", e = "error";
	$('input, textarea')
	.each(function(){
		if($(this).val() == n){
		  $(this).val($(this).attr(w));
		}
		else {
		  $(this).addClass(d);
		}
	})
	.focus(function(){
		$(this).removeClass(e);
		$(this).removeClass(d);
		$(this).addClass(f);
		if($(this).val() == $(this).attr(w))
		   $(this).val(n);
	})
	.blur(function(){
		if($(this).val() == n)
		{
		  $(this).val($(this).attr(w));
		  $(this).removeClass(f);
		}
		else {
		  $(this).removeClass(f);
		  $(this).addClass(d);
		}
	});
});