<?php

# require..
# ...
$path	= "..";
require_once("{$path}/config/ini.php");

# fetch..
# ...
$out	= (!$_GET['output'] ? "json" : $_GET['output']);
$os		= (!$_GET['os'] ? "ios" : $_GET['os']);

if($os == "android"){
	$res = $Books->select();
}
else {
	$res = $Books->select();
}

# settings..
# ...
$data->data 	= $Books->restObjects($res);
$data->success	= 1;

# output..
# ...
output($data, $out);

?>