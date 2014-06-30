<?php

# require..
# ...
$path	= "..";
require_once("{$path}/config/ini.php");

# fetch..
# ...
$out	= (!$_GET['output'] ? "json" : $_GET['output']);
$res	= $Passes->select();
/*
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
}*/

# settings..
# ...
$data->data 	= $res;
$data->total	= count($res);

# output..
# ...
output($data, $out);

?>