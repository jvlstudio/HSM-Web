<?php

# require..
# ...
$path	= "..";
require_once("{$path}/config/ini.php");

# fetch..
# ...
$out	= (!$_GET['output'] ? "json" : $_GET['output']);
$res	= $Home->get();

# settings..
# ...
$data->data 	= $res;
$data->success	= 1;

# output..
# ...
output($data, $out);

?>