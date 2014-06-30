<?php

# require..
# ...
$path	= "..";
require_once("{$path}/config/ini.php");

# fetch..
# ...
$event	= $_GET['event'];
$out	= (!$_GET['output'] ? "json" : $_GET['output']);
$os		= (!$_GET['os'] ? "ios" : $_GET['os']);

/*
if($os == "android"){
	$res = $Books->select();
}
else {
	$res = $Books->select();
}*/

if (!$event) {
	$data->message 	= "O Evento não foi localizado.";
	$data->success	= 0;
	output($data, $out);
}

$res	= $Passes->forEventId($event);
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
$data->data 	= $Passes->restObjects($res);
$data->success	= 1;

# output..
# ...
output($data, $out);

?>