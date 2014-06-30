<?php

# require..
# ...
$path	= "..";
require_once("{$path}/config/ini.php");

# vars (settings)..
# ...
$out	= (!$_GET['output'] ? "json" : $_GET['output']);
$data	= new stdClass;
$src	= new stdClass;

# vars (params)..
# ...
$user	= $_GET['user_id'];
$ad		= $_GET['ad_id'];
$latlng	= $_GET['latlng'];

# verify
# ...
if (!$ad)
{
	$src->error	= "Missing Arguments";
}
# fetching..
# ...
else {
	$Ads->saveActivity($user, $ad, $latlng);
	$Ads->hitView($ad);
	$src->status	= "OK";
}

# settings ..
# ...
$data->data		= $src;
$data->success	= 1;

# output ..
# ...
output($data, $out);

?>