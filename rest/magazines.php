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
	$res = $Magazines->select();
}
else {
	$res = $Magazines->select();
}
# settings..
# ...
$data->data 	= $Magazines->restObjects($res);
$data->success	= 1;

# output..
# ...
output($data, $out);

?>