<?php

# default object
$Tb = $Ads;

# vars
$scope	= $_POST['scope'];
$slug	= $Tb->permalink($_POST['name']);
$id		= $_POST["id"];
$now	= date("Y-m-d H:i:s");

$cam	= (object) $Tb->campaign($_POST['campaign_id']);
$client_id = $cam->client_id;

# d start..
$dsx	= explode("/", $_POST['date_start']);
$dsi	= array_reverse($dsx);
$dstart	= implode("-", $dsi);
$dstartx= $dstart . " " . $_POST['hour_start'];
# d end..
$dex	= explode("/", $_POST['date_end']);
$dei	= array_reverse($dex);
$dend	= implode("-", $dei);
$dendx	= $dend . " " . $_POST['hour_end'];

# options..
$opt		= (object) $_POST['opt'];
$options	= $Ads->optionString($opt->gender, $opt->age_start, $opt->age_end);

if(	!$scope )
	return_inside("/midia/{$args->dir}");
	
# image ios..
$prefix			= "ad_ios_{$_POST['type']}_";
$sufix			= "@2x";
$file_name 		= $_FILES['image_ios'];
include("handle-images.php");
$image_ios		= $image;
# image ios exp..
$prefix			= "ad_ios_exp_{$_POST['type']}_";
$sufix			= "@2x";
$file_name 		= $_FILES['image_ios_exp'];
include("handle-images.php");
$image_ios_exp	= $image;
# image android..
$prefix			= "ad_android_{$_POST['type']}_";
$sufix			= "";
$file_name 		= $_FILES['image_android'];
include("handle-images.php");
$image_android	= $image;
# image android exp..
$prefix			= "ad_android_exp_{$_POST['type']}_";
$sufix			= "";
$file_name 		= $_FILES['image_android_exp'];
include("handle-images.php");
$image_android_exp	= $image;
	
# handle scope
switch ($scope):
	
	# ...
	case "add":
		$rid = $Tb->add("campaign_id={$_POST['campaign_id']}",
						"client_id={$client_id}",
						"object_id={$_POST['object_id']}",
						"table=none",
						"type={$_POST['type']}",
						"image_ios={$image_ios}",
						"image_android={$image_android}",
						"image_ios_exp={$image_ios_exp}",
						"image_android_exp={$image_android_exp}",
						"link={$_POST['link']}",
						"count_views=0",
						"count_clicks=0",
						"position={$_POST['position']}",
						"latlng={$_POST['latlng']}",
						"date_register={$now}" );
		# return
		return_inside("/midia/{$args->dir}");
		break;
	
	# ...
	case "edit":
		$Tb->update($id,
					//"campaign_id={$_POST['campaign_id']}",
					"client_id={$client_id}",
					"object_id={$_POST['object_id']}",
					//"table={$_POST['table']}",
					//"type={$_POST['type']}",
					"link={$_POST['link']}",
					"position={$_POST['position']}",
					"latlng={$_POST['latlng']}",
					"date_register={$now}" );
		# update images..
		if (!empty($image_ios))
		{
			$el = (object) $Tb->forId($id);
			if($el->image_ios)
				unlink("../uploads/ads/".$el->image_ios);
			// ..
			$Tb->update($id, "image_ios={$image_ios}");
		}
		if (!empty($image_ios_exp))
		{
			$el = (object) $Tb->forId($id);
			if($el->image_ios_exp)
				unlink("../uploads/ads/".$el->image_ios_exp);
			// ..
			$Tb->update($id, "image_ios_exp={$image_ios_exp}");
		}
		if (!empty($image_android))
		{
			$el = (object) $Tb->forId($id);
			if($el->image_android)
				unlink("../uploads/ads/".$el->image_android);
			// ..
			$Tb->update($id, "image_android={$image_android}");
		}
		if (!empty($image_android_exp))
		{
			$el = (object) $Tb->forId($id);
			if($el->image_android_exp)
				unlink("../uploads/ads/".$el->image_android_exp);
			// ..
			$Tb->update($id, "image_android_exp={$image_android_exp}");
		}
		# return
		return_inside("/midia/{$args->dir}");
		break;
	
	# ...
	case "remove":
		$Tb->delete($id);
		# return
		echo "ok";
		break;
	
	# categories
	# ...
	case "add-campaign":
		$Tb->setTable("campaigns");
		$rid = $Tb->add("client_id={$_POST['client_id']}",
						"name={$_POST['name']}",
						"slug={$slug}",
						"options={$options}",
						"date_start={$dstartx}",
						"date_end={$dendx}",
						"date_register={$now}" );
		# return
		return_inside("/midia/{$args->dir}");
		break;
		
	# ...
	case "edit-campaign":
		$Tb->setTable("campaigns");
		$Tb->update($id,
					"client_id={$_POST['client_id']}",
					"name={$_POST['name']}",
					"slug={$_POST['slug']}",
					"options={$options}",
					"date_start={$dstartx}",
					"date_end={$dendx}",
					"date_register={$now}" );
		# return
		return_inside("/midia/{$args->dir}");
		break;
	
	# ...
	case "remove-campaign":
		$Tb->deleteCampaign($id);
		# return
		echo "ok";
		break;
		
endswitch;

?>