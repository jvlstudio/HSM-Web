<?php

# default object
$Tb = $Events;

# vars
$scope	= $_POST['scope'];
$id		= $_POST["id"];
$now	= date("Y-m-d H:i:s");
$slug	= $_POST['slug'] ? $_POST['slug'] : $Tb->permalink($_POST['name']);
$dates	= implode("|", $_POST["info_dates"]);

if(	!$scope )
	return_to("/{$args->dir}");
	
# images
$file = $_FILES['image_list'];
include("handle-uploads.php");
$image_list = $document;

$file = $_FILES['image_single'];
include("handle-uploads.php");
$image_single = $document;
	
# handle scope
switch ($scope):
	
	# ...
	case "add":
		$rid = $Tb->add("name={$_POST['name']}",
						"description={$_POST['description']}",
						"tiny_description={$_POST['tiny_description']}",
						"slug={$slug}",
						"info_dates={$dates}",
						"info_hours={$_POST['info_hours']}",
						"info_locale={$_POST['info_locale']}",
						"image_list={$image_list}",
						"image_single={$image_single}",
						"date_register={$now}" );
		# return
		return_inside("/backend/{$args->dir}");
		break;
		
	# ...
	case "edit":
		$rid = $Tb->update(	$id,
							"name={$_POST['name']}",
							"description={$_POST['description']}",
							"tiny_description={$_POST['tiny_description']}",
							"slug={$slug}",
							"info_dates={$dates}",
							"info_hours={$_POST['info_hours']}",
							"info_locale={$_POST['info_locale']}",
							"image_list={$image_list}",
							"image_single={$image_single}" );
		# return
		return_inside("/backend/{$args->dir}");
		break;
		
	# ...
	case "remove":
		$Tb->deleteItem($id);
		# return
		echo "ok";
		break;
		
endswitch;

?>