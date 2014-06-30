<?php

# default object
$Tb = $Passes;

# vars
$scope	= $_POST['scope'];
$id		= $_POST["id"];
$now	= date("Y-m-d H:i:s");
$slug	= $Tb->permalink($_POST['name']);

if(	!$scope )
	return_to("/{$args->dir}");
	
# handle scope
switch ($scope):
	
	# ...
	case "add":
		$rid = $Tb->add("name={$_POST['name']}",
						"email={$_POST['email']}",
						"slug={$slug}",
						"event_id={$_POST['event_id']}",
						"color={$_POST['color']}",
						"price_from={$_POST['price_from']}",
						"price_to={$_POST['price_to']}",
						"valid_to={$_POST['valid_to']}",
						"description={$_POST['description']}",
						"days={$_POST['days']}",
						"show_dates={$_POST['show_dates']}",
						"is_multiple={$_POST['is_multiple']}",
						"date_register={$now}" );
		# return
		return_inside("/backend/{$args->dir}");
		break;
		
	# ...
	case "edit":
		$rid = $Tb->update(	$id,
							"name={$_POST['name']}",
							"email={$_POST['email']}",
							"slug={$slug}",
							"event_id={$_POST['event_id']}",
							"color={$_POST['color']}",
							"price_from={$_POST['price_from']}",
							"price_to={$_POST['price_to']}",
							"valid_to={$_POST['valid_to']}",
							"description={$_POST['description']}",
							"days={$_POST['days']}",
							"show_dates={$_POST['show_dates']}",
							"is_multiple={$_POST['is_multiple']}" );
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