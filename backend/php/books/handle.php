<?php

# default object
$Tb = $Books;

# vars
$scope	= $_POST['scope'];
$id		= $_POST["id"];
$now	= date("Y-m-d H:i:s");
$slug	= $_POST['slug'] ? $_POST['slug'] : $Tb->permalink($_POST['name']);

if(	!$scope )
	return_to("/{$args->dir}");
	
# images
$file = $_FILES['picture'];
include("handle-uploads.php");
$picture = $document;
	
# handle scope
switch ($scope):
	
	# ...
	case "add":
		$rid = $Tb->add("name={$_POST['name']}",
						"description={$_POST['description']}",
						//"tiny_description={$_POST['tiny_description']}",
						"slug={$slug}",
						"author_name={$_POST['author_name']}",
						"author_description={$_POST['author_description']}",
						"link={$_POST['link']}",
						"picture={$picture}",
						"date_register={$now}" );
		# return
		return_inside("/backend/{$args->dir}");
		break;
		
	# ...
	case "edit":
		$rid = $Tb->update(	$id,
							"name={$_POST['name']}",
							"description={$_POST['description']}",
							//"tiny_description={$_POST['tiny_description']}",
							"slug={$slug}",
							"author_name={$_POST['author_name']}",
							"author_description={$_POST['author_description']}",
							"link={$_POST['link']}",
							"picture={$picture}" );
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