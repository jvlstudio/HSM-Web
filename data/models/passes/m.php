<?php 

interface iPasses
{
	public function select($param="");
	public function get($param="");
	public function forId($id, $param="");
	public function forKey($value, $key="id");
	public function forEventId($key, $param="");
	public function forEventSlug($key, $param="");
	# ...
	public function colors();
	public function days();
	public function labelForColor($color);
}

class Passes extends Functions implements iPasses
{
	# ...
	
	public function restObject( $obj )
	{
		global $Events, $Panelists;
			
		$obj = (object) $obj;
	
		$rest			= new stdClass;
		$event			= $Events->forId($obj->event_id);
		
		$_event			= new stdClass;
		$_event->id		= $event->id;
		$_event->name	= $event->name;
		$_event->slug	= $event->slug;
		
		$_meta			= new stdClass;
		$_meta->days	= $obj->days;
		$_meta->dates	= $Events->datesFrom($event);
		$_meta->show_dates	= $obj->show_dates;
		$_meta->is_multiple	= $obj->is_multiple;
		
		# rest..
		$rest->id		= $obj->id;
		$rest->event	= $_event;
		$rest->color	= $obj->color;
		$rest->name		= $obj->name;
		$rest->slug		= $obj->slug;
		$rest->price_from	= $obj->price_from;
		$rest->price_to		= $obj->price_to;
		$rest->valid_to	= $obj->valid_to;
		$rest->email	= $obj->email;
		$rest->description = $obj->description;
		$rest->meta		= $_meta;
		
		return $rest;
	}
	public function restObjects( $array )
	{
		$result = array();
		foreach ($array as $object)
			$result[] = $this->restObject($object);
		return $result;
	}
	
	# ...
	
	public function select( $param="" )
	{
		$query	= "SELECT * FROM {$this->tb} {$param}";
		$res	= $this->db->results($query);
		return $res;
	}
	public function get( $param="" )
	{
		$res	= $this->db->result("SELECT * FROM {$this->tb} {$param}");
		$obj	= (object) $res;
		return $obj;
	}
	public function forId( $id, $param="" )
	{
		$res	= $this->get("WHERE id='{$id}'");
		return $res;
	}
	public function forKey( $value, $key="id" )
	{
		$res	= $this->get("WHERE {$key}='{$value}'");
		return $res;
	}
	public function forEventId($key, $param="")
	{
		$res	= $this->select("WHERE event_id='{$key}' {$param}");
		return $res;
	}
	public function forEventSlug($key, $param="")
	{
		$res	= $this->select("WHERE event_slug='{$key}' {$param}");
		return $res;
	}
	public function labelForColor($color)
	{
		$r = "";
		$values = $this->colors();
		foreach ($values as $value)
			if($value->slug == $color)
				$r = $value->label;
				
		return $r;
	}
	
	# ...
	
	public function colors()
	{
		$ev1 = array("slug" => "green", "label" => "Verde");
		$ev2 = array("slug" => "gold", "label" => "Dourado");
		$ev3 = array("slug" => "red", "label" => "Vermelho");
		
		return array((object) $ev1, (object) $ev2, (object) $ev3);
	}
	public function days()
	{
		$ev1 = array("slug" => "single", "label" => "Válido para um dia");
		$ev2 = array("slug" => "multiple", "label" => "Válido para todos os dias do evento");
		
		return array((object) $ev1, (object) $ev2);
	}
}

?>