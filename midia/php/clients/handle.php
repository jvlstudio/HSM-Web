<?php

# default object
$Tb = $Ads;
$Tb->setTable('clients');

# vars
$scope	= $_POST['scope'];
$slug	= $Tb->permalink($_POST['name']);
$id		= $_POST["id"];
$now	= date("Y-m-d H:i:s");

if(	!$scope )
	return_inside("/midia/{$args->dir}");
	
# handle scope
switch ($scope):
	
	# ...
	case "add":
		$rid = $Tb->add("name={$_POST['name']}",
						"slug={$slug}",
						"date_register={$now}" );
		# return
		return_inside("/midia/{$args->dir}");
		break;
	
	# ...
	case "edit":
		$Tb->update($id,
					"name={$_POST['name']}",
					"slug={$_POST['slug']}" );
		# return
		return_inside("/midia/{$args->dir}");
		break;
	
	# ...
	case "remove":
		$Tb->deleteClient($id);
		# return
		echo "ok";
		break;
		
endswitch;

?>