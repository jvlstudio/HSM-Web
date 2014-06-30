<?php

# require..
# ...
$path	= "..";
require_once("{$path}/config/ini.php");

# vars
# ...
$id 	= $_GET['id'];
$res	= (object) $Ads->forId($id);
$Ads->hitClick($id);

header("Location: {$res->link}");

?>