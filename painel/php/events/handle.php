<?php

@session_start();

# class..
$Tb 			= $Events;
$TbAgenda		= $Agenda;
$TbPanelist		= $Panelists;
$TbPasses		= $Passes;

# vars...
$id		= $_REQUEST['id'];
$scope	= $_REQUEST['scope'];
$now	= date("Y-m-d H:i:s");
if ($_POST["info_dates"] != null) {
	$dates	= implode(" - ", $_POST["info_dates"]);	
}


# image..
$prefix			= "event_";
$sufix			= "@2x";
$file_name 		= $_FILES["image"];
$max_width		= $_POST["image_width"];
$max_height		= $_POST["image_height"];
$image			= NULL;
include("handle-uploads.php");

# return..
if (!$scope)
	return;

# handle scope
switch ($scope):
	
	# ======================================= EVENT HANDLER
	# ...
	case "add":
		$slug = $Tb->permalink($_POST['name']);
		$Tb->add("name={$_POST['name']}",
				"description={$_POST['description']}",
				"tiny_description={$_POST['tiny_description']}",
				"slug={$slug}",
				"info_dates={$dates}",
				"info_hours={$_POST['info_hours']}",
				"info_locale={$_POST['info_locale']}",
				"date_register={$now}" );
		# return
		return_inside("/painel/{$args->dir}/thanks");
		break;
	
	# ...
	case "edit":
	
		$slug = $Tb->permalink($_POST['name']);
		$Tb->update($id,
				 	"name={$_POST['name']}",
		 			"description={$_POST['description']}",
		 			"tiny_description={$_POST['tiny_description']}",
		 			"slug={$slug}",
		 			"info_dates={$dates}",
		 			"info_hours={$_POST['info_hours']}",
		 			"info_locale={$_POST['info_locale']}");
		
		# update images..
		if (!empty($image))
		{
			$el = (object) $Tb->forId($id);
			if($el->picture)
				@unlink("../uploads/events/".$el->picture);
			// ..
			$Tb->update($id, "picture={$image}");
		}
		
		# return
		return_inside("/painel/{$args->dir}/thanks");
		break;
		
	# ...
	case "remove":
		$Tb->deleteItem($id);
		# return
		echo "ok";
		break;
		
	# ======================================= AGENDA HANDLER
	# ...
	case "add-agenda":
		$dates = $Tb->datesFrom($Tb->forId($_POST['event_id']));
		$data = $dates[$_POST['date']];

		# conversão de string para date;
		$array_data = explode("/", $data);
		$array_data = array_reverse($array_data);
		$data = implode("-", $array_data);
		
		#define a data de inicio.
		$dt_inicio = $data." ".$_POST['date_start'];

		#define a data de fim.		
		$dt_fim = $data." ".$_POST['date_end'];
		 
		$TbAgenda->add("type={$_POST['type']}",
				"event_id={$_POST['event_id']}",
				"panelist_id={$_POST['panelist_id']}",
				"date={$_POST['date']}",
				"date_start={$dt_inicio}",
				"date_end={$dt_fim}",
				"theme_title={$_POST['theme_title']}",
				"theme_description={$_POST['theme_description']}",
				"label={$_POST['label']}",
				"sublabel={$_POST['sublabel']}",
				"image={$image}",
				"date_register={$now}" );
		# return
		return_inside("/painel/{$args->dir}/thanks");
		break;
	
	# ...
	case "edit-agenda":
		
		$dates = $Tb->datesFrom($Tb->forId($_POST['event_id']));
		$data = $dates[$_POST['date']];
		
		# conversão de string para date;
		$array_data = explode("/", $data);
		$array_data = array_reverse($array_data);
		$data = implode("-", $array_data);
				
		#define a data de inicio.
		$dt_inicio = $data." ".$_POST['date_start'];
		
		#define a data de fim.		
		$dt_fim = $data." ".$_POST['date_end'];

		$TbAgenda->update($id,
				 	"type={$_POST['type']}",
				 	"event_id={$_POST['event_id']}",
					"panelist_id={$_POST['panelist_id']}",
				 	"date={$_POST['date']}",
				 	"date_start={$dt_inicio}",
				 	"date_end={$dt_fim}",
				 	"theme_title={$_POST['theme_title']}",
				 	"theme_description={$_POST['theme_description']}",
				 	"label={$_POST['label']}",
				 	"sublabel={$_POST['sublabel']}");
		
		# update images..
		if (!empty($image))
		{
			$el = (object) $TbAgenda->forId($id);
			if($el->picture)
				@unlink("../uploads/events/agenda/".$el->picture);
			// ..
			$TbAgenda->update($id, "image={$image}");
		}
		
		# return
		return_inside("/painel/{$args->dir}/thanks");
		break;
		
	# ...
	case "remove-agenda":
		$TbAgenda->deleteItem($id);
		# return
		echo "ok";
		break;
		
	# ======================================= PANELIST HANDLER
	# ...
	case "add-panelists":
		$slug = $TbPanelist->permalink($_POST['name']);
		$TbPanelist->add("name={$_POST['name']}",
				"slug={$slug}",
				"description={$_POST['description']}",
				"picture={$image}",
				"date_register={$now}");
		# return
		return_inside("/painel/{$args->dir}/thanks");
		break;
	
	# ...
	case "edit-panelists":
		$slug = $TbPanelist->permalink($_POST['name']);
		$TbPanelist->update($id,
				 	"name={$_POST['name']}",
				 	"slug={$slug}",
				 	"description={$_POST['description']}");
		
		# update images..
		if (!empty($image))
		{
			$el = (object) $TbPanelist->forId($id);
			if($el->picture)
				@unlink("../uploads/events/panelist/".$el->picture);
			// ..
			$TbPanelist->update($id, "picture={$image}");
		}
		
		# return
		return_inside("/painel/{$args->dir}/thanks");
		break;
		
	# ...
	case "remove-panelists":
		$TbPanelist->deleteItem($id);
		# return
		echo "ok";
		break;
		
	# ======================================= PASSE HANDLER
	# ...
	case "add-passes":
		$slug = $TbPasses->permalink($_POST['name']);
		$event = $Tb->forId($_REQUEST['event_id']);
		$TbPasses->add("event_id={$_POST['event_id']}",
				"event_name={$event->name}",
				"event_slug={$event->slug}",
				"color={$_POST['color']}",
				"name={$_POST['name']}",
				"slug={$slug}",
				"price_from={$_POST['price_from']}",
				"price_to={$_POST['price_to']}",
				"valid_to={$_POST['valid_to']}",
				"email={$_POST['email']}",
				"description={$_POST['description']}",
				"days={$_POST['days']}",
				"dates={$dates}",
				"show_dates={$_POST['show_dates']}",
				"is_multiple={$_POST['is_multiple']}",
				"date_register={$now}");
		# return
		return_inside("/painel/{$args->dir}/thanks");
		break;
	
	# ...
	case "edit-passes":
		$slug = $Tb->permalink($_POST['name']);
		$TbPasses->update($id,
				 	"color={$_POST['color']}",
				 	"name={$_POST['name']}",
				 	"slug={$slug}",
				 	"price_from={$_POST['price_from']}",
				 	"price_to={$_POST['price_to']}",
				 	"valid_to={$_POST['valid_to']}",
				 	"email={$_POST['email']}",
				 	"description={$_POST['description']}",
				 	"days={$_POST['days']}",
				 	"dates={$dates}",
				 	"show_dates={$_POST['show_dates']}",
				 	"is_multiple={$_POST['is_multiple']}");
				
		# return
		return_inside("/painel/{$args->dir}/thanks");
		break;
		
	# ...
	case "remove-passes":
		$TbPasses->deleteItem($id);
		# return
		echo "ok";
		break;
		
endswitch;

?>