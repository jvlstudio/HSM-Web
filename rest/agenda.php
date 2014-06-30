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

$res = array();
if ($event){
	$res	= $Agenda->forEvent($event);
}
else {
	// ...
	if($os == "android"){
		$events = $Events->select();
		foreach($events as $ev):
			$ev = (object) $ev;
			$agenda = $Agenda->forEvent($ev->id);
			$obj = new stdClass;
			$obj->event_id	 = $ev->id;
			$obj->event_name = $ev->name;
			$obj->event_slug = $ev->slug;
			$obj->agenda	 = $Agenda->restObjects($agenda);
			$res[] = $obj;
		endforeach;
	}
	else {
		$events = $Events->select();
		foreach($events as $ev):
			$ev = (object) $ev;
			$agenda = $Agenda->forEvent($ev->id);
			$obj = new stdClass;
			$obj->event_id	 = $ev->id;
			$obj->event_name = $ev->name;
			$obj->event_slug = $ev->slug;
			$obj->agenda	 = $Agenda->restObjects($agenda);
			$res[] = $obj;
		endforeach;
	}
}

# settings..
# ...
$data->data 	= $res;
$data->success	= 1;

# output..
# ...
output($data, $out);

?>