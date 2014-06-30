<?php

# default object
$Tb = $Panelists;

# vars
$scope	= $_POST['scope'];
$id		= $_POST["id"];
$now	= date("Y-m-d H:i:s");
$slug	= $_POST['slug'] ? $_POST['slug'] : $Tb->permalink($_POST['name']);

if(	!$scope )
	return_to("/{$args->dir}");
	
# handle scope
switch ($scope):
	
	# ...
	case "add":
		$rid = $Tb->add("event_id={$_POST['event_id']}",
						"name={$_POST['name']}",
						"description={$_POST['description']}",
						"slug={$slug}",
						"picture={$_POST['picture']}",
						//"theme_title={$_POST['theme_title']}",
						//"theme_description={$_POST['theme_description']}",
						"date_register={$now}" );
		# return
		return_inside("/backend/{$args->dir}");
		break;
		
	# ...
	case "edit":
		$rid = $Tb->update(	$id,
							"event_id={$_POST['event_id']}",
							"name={$_POST['name']}",
							"description={$_POST['description']}",
							"slug={$slug}",
							"picture={$_POST['picture']}"
							//"theme_title={$_POST['theme_title']}",
							/*"theme_description={$_POST['theme_description']}"*/ );
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