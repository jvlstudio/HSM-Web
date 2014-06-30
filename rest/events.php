<?php

# require..
# ...
$path	= "..";
require_once("{$path}/config/ini.php");

# fetch..
# ...
$out	= (!$_GET['output'] ? "json" : $_GET['output']);
$os		= (!$_GET['os'] ? "ios" : $_GET['os']);

$res	= $Events->select();
$src	= array();

// ...
if($os == "android"){
	$src = $Events->select();
}
else {
	foreach ($res as $event) {
		$event = (object) $event;
		$agenda		= $Agenda->restObjects($Agenda->forEvent($event->id));
		$panelists	= $Panelists->restObjects($Panelists->forEvent($event->id));
		$passes		= $Passes->restObjects($Passes->forEventId($event->id));
		// info
		$obj		= new stdClass;
		$obj->info	= $Events->restObject($event);
		$obj->agenda= $agenda;
		$obj->panelists = $panelists;
		$obj->passes	= $passes;
		
		$src[] = $obj;
	}
}

# settings..
# ...
$data->data 	= $src;
$data->success	= 1;

# output..
# ...
output($data, $out);

?>