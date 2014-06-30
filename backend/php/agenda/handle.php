<?php

# default object
$Tb = $Agenda;
$event = (object) $Events->forId($_POST['event_id']);
$dates = explode("|", $event->info_dates);
$cdate = $dates[$_POST['date']];

$_dat = explode("/", $cdate);
$_dat = array_reverse($_dat);
$_dat2= implode("-", $_dat);

# vars
$scope	= $_POST['scope'];
$id		= $_POST["id"];
$now	= date("Y-m-d H:i:s");
$slug	= $_POST['slug'] ? $_POST['slug'] : $Tb->permalink($_POST['name']);

$date1	= $_dat2." ".$_POST['hour_start'].":00";
$date2	= $_dat2." ".$_POST['hour_end'].":00";

if(	!$scope )
	return_to("/{$args->dir}");
	
# handle scope
switch ($scope):
	
	# ...
	case "add":
		$rid = $Tb->add("type={$_POST['type']}",
						"event_id={$_POST['event_id']}",
						"panelist_id={$_POST['panelist_id']}",
						"date={$_POST['date']}",
						"date_start={$date1}",
						"date_end={$date2}",
						"theme_title={$_POST['theme_title']}",
						"theme_description={$_POST['theme_description']}",
						"label={$_POST['label']}",
						"sublabel={$_POST['sublabel']}",
						"image={$_POST['image']}",
						"date_register={$now}" );
		# return
		return_inside("/backend/{$args->dir}");
		break;
		
	# ...
	case "edit":
		$rid = $Tb->update(	$id,
							"type={$_POST['type']}",
							"panelist_id={$_POST['panelist_id']}",
							"date={$_POST['date']}",
							"date_start={$date1}",
							"date_end={$date2}",
							"theme_title={$_POST['theme_title']}",
							"theme_description={$_POST['theme_description']}",
							"label={$_POST['label']}",
							"sublabel={$_POST['sublabel']}",
							"image={$_POST['image']}" );
		# return
		return_inside("/backend/{$args->dir}");
		break;
		
	# ...
	case "remove":
		$Tb->delete($id);
		# return
		echo "ok";
		break;
		
endswitch;

?>