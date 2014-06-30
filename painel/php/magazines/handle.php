<?php

@session_start();

# class..
$Tb 	= $Magazines;

# vars...
$id		= $_REQUEST['id'];
$scope	= $_REQUEST['scope'];
$now	= date("Y-m-d H:i:s");

# image..
$prefix			= "magazine_";
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
	
	# ...
	case "add":
		$description = "{$_POST['period_from']}/{$_POST['period_to']}";
		$slug = $Tb->permalink($_POST['name']);
		$Tb->add("name={$_POST['name']}",
				 "slug={$slug}",
				 "picture={$image}",
				 "description={$description}");
		# return
		return_inside("/painel/{$args->dir}/thanks");
		break;
	
	# ...
	case "edit":
	
		$slug = $Tb->permalink($_POST['name']);
		$description = "{$_POST['period_from']}/{$_POST['period_to']}";
		$Tb->update($id,
				 	"name={$_POST['name']}",
				 	"slug={$slug}",
				 	"description={$description}",
				 	"link={$_POST['link']}");
		
		# update images..
		if (!empty($image))
		{
			$el = (object) $Tb->forId($id);
			if($el->picture)
				@unlink("../uploads/magazines/".$el->picture);
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
		
endswitch;

?>