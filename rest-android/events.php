<?php

# require..
# ...
$path	= "..";
require_once("{$path}/config/ini.php");

# fetch..
# ...
$out	= (!$_GET['output'] ? "json" : $_GET['output']);
$res	= $Events->select();

# settings..
# ...
$data->data 	= $res;
$data->total	= count($res);

# output..
# ...
output($data, $out);

?>