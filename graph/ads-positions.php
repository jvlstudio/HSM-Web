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
$type	= $_GET['type'];

# fetch..
# ...
$res		= $Ads->positionsLabels($type);

# settings..
# ...
$data->data 	= $res;
$data->total	= count($src);

# output..
# ...
output($data, $out);


?>