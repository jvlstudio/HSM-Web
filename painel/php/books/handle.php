<?php

@session_start();

# class..
$Tb 	= $Books;

# vars...
$id		= $_REQUEST['id'];
$scope	= $_REQUEST['scope'];
$now	= date("Y-m-d H:i:s");

# image..
$prefix			= "book_";
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
	
		$slug = $Tb->permalink($_POST['name']);
		$Tb->add("name={$_POST['name']}",
				 "slug={$slug}",
				 "description={$_POST['description']}",
				 "picture={$image}",
				 "author_name={$_POST['author_name']}",
				 "author_description={$_POST['author_description']}",
				 "link={$_POST['link']}",
				 "date_register={$now}");
		# return
		return_inside("/painel/{$args->dir}/thanks");
		break;
	
	# ...
	case "edit":
	
		$slug = $Tb->permalink($_POST['name']);
		$Tb->update($id,
				 	"name={$_POST['name']}",
				 	"slug={$slug}",
				 	"description={$_POST['description']}",
				 	"author_name={$_POST['author_name']}",
				 	"author_description={$_POST['author_description']}",
				 	"link={$_POST['link']}");
		
		# update images..
		if (!empty($image))
		{
			$el = (object) $Tb->forId($id);
			if($el->picture)
				@unlink("../uploads/books/".$el->picture);
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