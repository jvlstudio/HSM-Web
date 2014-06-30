/* JS MODELS */

/* WINDOW
	Handle window binds */

$(window)
.bind("load", function(){
	$("#loader").fadeOut();
})
.bind("resize", handleResponsiveScreen);

/* DOCUMENT
	When document is ready */

$(document)
.bind("ready", function() {
	
	// methods
	handleResponsiveScreen();
	
	// menu
	$(".menu_option").bind("click", function(){
		var $self	= $(this);
		if($self.attr("url")) {
			var request_url = site_url + "/" + $(this).attr("url");
			window.location = request_url;
		}
		else {
			var menu 	= $self.attr("menu");
			var $submenu= $(".submenu[supermenu=\""+menu+"\"]");
			var $icon	= $self.find("i").eq(0);
			// currently open..
			var $open_self	= $(".menu_option.selected");
			var open_menu	= $open_self.attr("menu");
			var $open_smenu	= $(".submenu[supermenu=\""+open_menu+"\"]");
			var $open_icon	= $open_self.find("i").eq(0);
			//
			if($open_self != $self){
				$open_smenu.slideUp("fast");
				$open_self.removeClass("selected");
				rotate($open_icon, 0);
			}
			// self open..
			if($submenu.css("display") == "none"){
				$submenu.slideDown("fast");
				$self.addClass("selected");
				rotate($icon, 180);
			} else {
				$submenu.slideUp("fast");
				$self.removeClass("selected");
				rotate($icon, 0);
			}
		}
	});
	// submenu
	$(".submenu_option").bind("click", function(){
		var $self	= $(this);
		if($self.attr("url")) {
			var request_url = site_url + "/" + $(this).attr("url");
			window.location = request_url;
		}
		else {
			var menu 	= $self.attr("menu");
			var $submenu= $(".downmenu[supermenu=\""+menu+"\"]");
			var $icon	= $(this).find("i").eq(1);
			// currently open..
			var $open_self	= $(".submenu_option.selected");
			var open_menu	= $open_self.attr("menu");
			var $open_smenu	= $(".downmenu[supermenu=\""+open_menu+"\"]");
			var $open_icon	= $open_self.find("i").eq(1);
			//
			if($open_self != $self){
				$open_smenu.slideUp("fast");
				$open_self.removeClass("selected");
				rotate($open_icon, 0);
			}
			// self open..
			if($submenu.css("display") == "none"){
				$submenu.slideDown("fast");
				$self.addClass("selected");
				rotate($icon, 90);
			} else {
				$submenu.slideUp("fast");
				$self.removeClass("selected");
				rotate($icon, 0);
			}
		}
	});
	$(".downmenu_option").bind("click", function(){
		var request_url = site_url + "/" + $(this).attr("url");
		window.location = request_url;
	});
	
	// home...
	$(".edit .icon").bind("click", function(){
		var request_url = site_url+"/"+model+"/"+$(this).attr("page");
		$("#modal iframe").attr("src", request_url);
		modalOpen();
	});
	$(".p-edit").bind("click", function(){
		var request_url = site_url+"/"+model+"/"+$(this).attr("page");
		$("#modal iframe").attr("src", request_url);
		modalOpen();
	});
	$(".action_add, .action_plus").bind("click", function(){
		var request_url = site_url+"/"+model+"/"+($(this).attr("page") != null ? $(this).attr("page") : "add" );
		$("#modal iframe").attr("src", request_url);
		modalOpen();
	});
	$(".action_submenu_add").bind("click", function(){
		var request_url = site_url+"/"+$(this).attr("action-url");
		$("#modal iframe").attr("src", request_url);
		modalOpen();
	});
	
	// modal..
	$("#modal_close_form").bind("click", modalClose);
	$(".action_remove").bind("click", function(){
		removeObject( $(this).attr("data-id"), model );
	});
	
	$('.date_mask').mask('99/99/9999');
	$('.hour_mask').mask('99:99');
	$('.phone_mask').mask('(99) 9999-9999');
	$( ".date_pick" )
	.live("focus",function(){
		$(this).datepicker({
		  dateFormat: "dd/mm/yy",
		  changeMonth: true,
		  numberOfMonths: 2
		});
	});
	
	// dates..
	$(".adddate")
	.bind("click",function(){
		var $wrap = $(".more_dates");
		var field = '<div><input type="text" name="info_dates[]" class="date_pick textfield" style="width:90%" /> <i class="fa fa-times removedate datehandle"></i></div>';
		$wrap.append(field);
	});
	$(".removedate")
	.live("click",function(){
		var $parent = $(this).parent();
		$parent.remove();
	});
	
	// sortable..
	$(".regular_list .items").sortable();/*{
	    update: function (event, ui) {
	    	var $self = $(this);
	        
	        var data = $(this).sortable('serialize');
	        // POST to server using $.post or $.ajax
	        $.ajax({
	            data: data,
	            type: 'POST',
	            url: handle_url,
	            beforeSend: function(){
	            	$self.css("opacity", "0.5");
	            },
	            success: function(txt){
	            	$self.css("opacity", "1");
	            	console.log(txt);
	            },
	            error: function(txt){
	            	$self.css("opacity", "1");
	            	alert(txt);
	            }
	        });
	    }
	}*/
	//.disableSelection();
	
});

/* FUNCTIONS
	JS scripts */

// manipulate heights
function handleResponsiveScreen()
{
	var $window		= $(window);
	var $sidebar	= $("#sidebar");
	var $controller	= $("#controller");
	var $bcontent	= $("#body_content");
	var $container	= $("#controller .container");
	var $topbar		= $("#controller .topbar");
	
	var padding		= 40;
	var winWidth 	= $(window).width();
	var winHeight	= $(window).height();
	
	$controller.css({"width":winWidth-302});
	$container.css({"width": $controller.width()-padding, "height": winHeight-$topbar.height()-padding-20});
}

// modal
function modalOpen()
{
	$("#modal").show();
	$("#modal_bg").fadeIn(600);
	$("#modal .wrapper").show().animate({"height":"95%", "margin-top":"5%"}, 600);
}
function modalClose()
{
	$("#modal .wrapper").animate({"height":"0%", "margin-top":"100%"}, 600, function(){
		$(this).hide();
		$("#modal").hide();
		$("#modal_bg").fadeOut('normal', function(){
			//...
			window.location.reload();
		});
	});
}

// validate form
function formValidate(obj)
{
	var hasError = false;
	var elements = "input[type=\"text\"], select, textarea";
	obj.find(elements).each(function(){
		$(this).removeClass("error");
		switch ($(this).prop("tagName")) {
			case "INPUT":
			case "TEXTAREA":
				if ($(this).val()==$(this).attr("watermark") && $(this).hasClass("required")) {
					$(this).addClass("error");
					hasError = true;
				}
				break;
			case "SELECT":
				if ($(this).val() == "" && $(this).hasClass("required")) {
					$(this).parent().find("span").addClass("error");
					hasError = true;
				}
				break;
		}
	});
	if (hasError) {
		$.scrollTo(0, 300);
		$("body").delay(300, function(){
			alert("Por favor, preencha os campos em vermelho.");
		});
		return false;
	}
	else {
		obj.find(elements).each(function(){
			if ($(this).val()==$(this).attr("watermark")){
				$(this).val("");
			}
		});
		return true;
	}
}

// rotate
function rotate(object, degree)
{
	object.css({ WebkitTransform: 'rotate(' + degree + 'deg)'});
	object.css({ '-moz-transform': 'rotate(' + degree + 'deg)'});
}

// remove..
function removeObject( object_id, current_model )
{
	var request_url = site_url + "/" + current_model + "/handle";
	var return_url  = site_url + "/home";
	console.log(request_url);
	if( confirm("Tem certeza que deseja excluir esse item?") )
	{
		$.ajax({
			type: "POST",
			url : request_url,
			data: { "scope" : "remove", "id" : object_id },
			beforeSend : function(){
				$("#page").css({"opacity":"0.5"});
			},
			success : function(txt){
				$("#page").css({"opacity":"1.0"});
				if(txt == "ok"){
					window.location = return_url;
				}else{
					alert("Ocorreu um erro: "+txt);
				}
			},
			error : function(txt){
				$("#page").css({"opacity":"1.0"});
				alert("Ocorreu um erro: "+txt);
			}
		});
		return false;
	}
}


/* Silence is golden */