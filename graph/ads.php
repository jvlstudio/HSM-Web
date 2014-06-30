<?php

# require..
# ...
$path	= "..";
require_once("{$path}/config/ini.php");

# vars (settings) ...
# ...
$out	= (!$_GET['output'] ? "json" : $_GET['output']);
$data	= new stdClass;
$src	= array();

# vars
# ...
$os			= ($_GET['os'] ? "_".$_GET['os'] : "_ios");
$gender		= $_GET['gender'];
$age		= $_GET['age'];
$type		= $_GET['type'];
$profile	= $Ads->optionProfile($gender, $age);

# fetch..
# ...
$res		= $Ads->today(NULL, NULL);
foreach ($res as $info)
{
	$info		= (object) $info;
	$obj		= new stdClass;
	$key_image	= "image{$os}";
	$key_image_exp = $key_image."_exp";
	
	$obj->id	= $info->id;
	$obj->pos	= $info->position;
	$obj->type	= "ads"; // for division on app..
	$obj->subtype = $info->type;
	$obj->image	= $info->$key_image;
	$obj->image_exp = $info->$key_image_exp;
	
	if ($type == "annotation_feat")
	{
		$lx = explode(",", $info->latlng);
		$latlng	= new stdClass;
		$latlng->lat	= $lx[0];
		$latlng->lng	= $lx[1];
		
		$cam = (object) $Ads->campaign($info->campaign_id);
		$obj->name		= $cam->name;
		$obj->slug		= str_replace("-", "_", $cam->slug);
		$obj->latlng	= $latlng;
	}
	
	$src[]		= $obj;
}

# settings..
# ...
$data->data 	= $src;
$data->total	= count($src);

# output..
# ...
output($data, $out);


?>