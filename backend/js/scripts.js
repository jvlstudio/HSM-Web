/* JS MODELS */

var a = "added";

$(function()
{	
	var w = "watermark", f = "focus", d = "done", n = "";
	
	/* watermark */
	$('input')
	.each(function()
	      {
	          if($(this).val() == n)
	              $(this).val($(this).attr(w));
	          else
	              $(this).addClass(d);
	      })
	.focus(function()
	       {
	           $(this).removeClass(d);
	           $(this).addClass(f);
	           if($(this).val() == $(this).attr(w))
	               $(this).val(n);
	       })
	.blur(function()
	      {
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
	
	// datepicker
	// ...
	$( "#ipt_date_start" ).datepicker({
      defaultDate: "+1w",
      dateFormat: "dd/mm/yy",
      changeMonth: true,
      numberOfMonths: 2,
      onClose: function( selectedDate ) {
        $( "#ipt_date_end" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#ipt_date_end" ).datepicker({
      defaultDate: "+1w",
      dateFormat: "dd/mm/yy",
      changeMonth: true,
      numberOfMonths: 2,
      onClose: function( selectedDate ) {
        $( "#ipt_date_start" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
    $( ".date_pick" )
    .live("focus",function(){
    	$(this).datepicker({
    	  dateFormat: "dd/mm/yy",
    	  changeMonth: true,
    	  numberOfMonths: 2
    	});
    });
    
    // toggle..
    // ...
    $('.toggle li h2')
    .bind('click', function(){
    	$t = $(this).parent().parent();
    	$c = $t.children('.container');
    	if ($c.css('display') == 'none')
    		$c.slideDown();
    	else
    		$c.slideUp();
    });
    
    // masks..
    // ...
    $('.date_mask').mask('99/99/9999');
    $('.hour').mask('99:99');
    $('.phone').mask('(99) 9999-9999');
    //$('.money').mask("#.##0,00", {reverse: true, maxlength: false});
    $('.money').maskMoney({
    	decimal: ",",
    	precision: 2,
    	thousands: ".",
    	showSymbol:false
    });
    
    // limiter
    // ...
    $("#ipt_name").limiter(80, $('#ipt_name_counter'));
    $("#ipt_description").limiter(1024, $('#ipt_description_counter'));
    
    // free snippet
    $('input[name=sticker_free]')
    .bind('change', function(){
    	if ($(this).val() == "yes")
    		$('#li_ticket').hide();
    	else
    		$('#li_ticket').show();
    });
    
    // validate
    // ...
    $("#form_values").validate();
    $("#bt_form")
    .bind('click', function(){
    	// email..
    	if($('#ipt_email'))
    	{
    		if(!validateEmail($('#ipt_email').val()))
    		{
    			alert("Por favor, digite um e-mail válido.");
    			return false;
    		}
    	}
    });
    
    // hours
    // ...
    $('.hours .days li')
    .bind('click', function(){
    	$t = $(this);
    	if ($t.hasClass(a))
    		$t.removeClass(a);
    	else
    		$t.addClass(a);
    	// ..
    });
    $('.hours .button')
    .bind('click', function()
    {
    	var $ul 	= $('#hours_saved'),
    		$days	= $('.hours .days li'),
    		$sdays	= $('.hours .days li.added');
    		$hstart	= $('#hour_start'),
    		$hend	= $('#hour_end'),
    		names 	= new Array(),
    		name	= "",
    		jname	= "";
    	
    	// days..
    	if ($sdays.length == 0)
    	{
    		alert("Por favor, escolha ao menos um dia.");
    		return false;
    	}
    	
    	// hour..
    	if (!$hstart.val()
    	|| 	!$hend.val())
    	{
    		alert("Por favor, insira o horário.");
    		return false;
    	}
    	/*
    	if (!validateHour($hstart.val())
    	|| 	!validateHour($hend.val()))
    	{
    		alert("Por favor, insira um horário válido.");
    		return false;
    	}*/
    	
    	$days.each(function(){
    		$c = $(this);
    		if ($c.hasClass(a))
    			names.push($c.text());
    	});
    	
    	name  = names.join(", ");
    	jname = names.join("|");
    	name += ": ";
    	name += $hstart.val() + " - " + $hend.val();
    	
    	var li  = '<li>'+name+' <a href="javascript:;" class="hour_remove">x</a>';
    		li += '<input type="hidden" name="schedule[]" value="'+jname+'-'+$hstart.val()+'|'+$hend.val()+'" /></li>';
    	$ul.append(li);
    	
    	// clear..
    	$days.each(function(){
    		$c = $(this);
    		if ($c.hasClass(a))
    			$c.removeClass(a);
    	});
    	$hstart.val("");
    	$hend.val("");
    	
    	return false;
    });
    $('.hour_remove')
    .live('click', function(){
    	$(this).parent().remove();
    });
    
    // tipsy..
    $('.tp-s').tipsy({gravity:'s'});
    
    // online..
    //setInterval(checkOnline, 1000);
    
    // type for positions
    $('#select_type, #select_campaign')
    .bind('change',function()
    {
    	loadPositions();
    });
    
    // search..
    $('#select_category')
    .bind('change', function(){
    	$select = $(this);
    	$('table tr td').each(function(){
    		var $parent = $(this).parent();
    		$parent.show();
    		if($select.val()){
    			if ($select.val() == $parent.attr('cat'))
    				$parent.show();
    			else
    				if (!$parent.hasClass('head'))
    					$parent.hide();
    		}else{
    			$parent.show();
    		}
    	});
    }); 
    
    // dates..
    $(".adddate")
    .bind("click",function(){
    	var $wrap = $("#dates_wrap");
    	var field = '<div><input type="text" name="info_dates[]" class="date_pick" /> <i class="fa fa-times removedate datehandle"></i></div>';
    	$wrap.append(field);
    });
    $(".removedate")
    .live("click",function(){
    	var $parent = $(this).parent();
    	$parent.remove();
    });
});

function loadPositions(position)
{
	var $li			= $('#li_position');
	var $lim		= $('.expanded');
	var $select		= $('#select_position');
	var $parent		= $('#select_type');
	var $form		= $('#form_values input, #form_values select, #form_values textarea');
	
	if (!$parent.val()){
		alert("Por favor, selecione um tipo.");
		return;
	}
	
	var url_request = handle_url+"/graph/ads-positions.php?type="+$parent.val();
	
	$form.each(function(){
		$(this).css('opacity', '0.5').attr('disabled', true);
	});
	
	$.getJSON( url_request, 
	function( data )
	{
		$form.each(function(){
			$(this).css('opacity', '1.0').attr('disabled', false);
		});
	
		var arr = data.data;
		
		if ($parent.val() == "banner_expand"
		||	position == "banner_expand")
			$lim.attr('disabled', false).css('opacity','1.0').val('');
		else
			$lim.attr('disabled', true).css('opacity', '0.5').val('');
		
		if (arr.length > 0)
		{
			$li.show();
			$select.empty();
			for (var i = 0; i < arr.length; i++)
			{
				var selected = (position && position == i ? "selected=\"selected\"" : "");
				var opt = "<option "+selected+" value=\""+i+"\">"+arr[i]+"</option>";
				$select.append(opt);
			}
		}
		else {
			$select.empty();
			$li.hide();
		}
	});
}

function checkOnline()
{
	$.getJSON( handle_url+"/graph/users-online.php", 
	function( data )
	{
		$('#online').text(data.data.total);
	});
}

function validateHour(hour)
{
    var re = /([00-23]):([00-59])/;
    return re.test(hour);
}

/* maps */

var geocoder, map;
	
function initialize()
{
		geocoder = new google.maps.Geocoder();
	var latlng = new google.maps.LatLng(-25.4283563,-49.2732515);
	var mapOptions = {
						zoom: 13,
						center: latlng,
						mapTypeId: google.maps.MapTypeId.ROADMAP
					 }
		map = new google.maps.Map(document.getElementById("google_map"), mapOptions);
}

function codeAddress()
{
	var address = document.getElementById("address").value;
		address += ", Curitiba";
	geocoder.geocode({'address': address}, function(results, status)
	{
		if (status == google.maps.GeocoderStatus.OK)
		{
			map.setCenter(results[0].geometry.location);
			map.setZoom(16);
			var marker = new google.maps.Marker({	map: map, 
													position: results[0].geometry.location 
												});
			var latlng 	= valuesToArray(results[0].geometry.location),
				lat 	= latlng[0],
				lng 	= latlng[1];
			$('#ipt_latlng').val(lat+','+lng);
			console.log(results);
			console.log(latlng);
		}
		else {
			alert("Geocode was not successful for the following reason: " + status);
		}
	});
}

google.maps.event.addDomListener(window, 'load', initialize);

/* actions */

function removeObject(dir, id_str, scope_str, rootdir)
{
	if(!rootdir)
		rootdir = "backend";

	var confirmMessage = confirm("Tem certeza que deseja excluir esse item? Ao fazer isso, TODOS o histórico deste item será deletado, inclusive eventos, categorias e/ou espaços culturais.");
	// ...
	if(confirmMessage)
	{
		var url_request = handle_url+'/'+rootdir+'/'+dir+'/handle';
		var $item = $('#item_'+id_str);
		console.log(url_request);
		
		$.ajax({
			type: 	'POST',
			url:	url_request,
			data:	{scope: scope_str, id: id_str},
			beforeSend:function(e){
				$item.css('opacity','0.5');
			},
			success:function(e){
				//if (e == "ok") {
					$item.slideUp();
				/*}
				else {
					$item.css('opacity','1');
					alert(e);
				}*/
			},
			error:function(e){
				$item.css('opacity','1');
				alert(e);
			}
		});
	}
}

/**/

function validateEmail(email)
{ 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
} 

function valuesToArray(obj)
{
	return Object.keys(obj).map(function(key){ return obj[key]; });
}

/**
 * @author	Felipe Ricieri
 * @version	2.0
 * @date	06/nov/2013
 ***********************************/