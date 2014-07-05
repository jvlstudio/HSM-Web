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
	public function delete($id);
	# ...
	public function events();
	public function colors();
	public function days();
	public function labelForColor($color);
}

class Passes extends Functions implements iPasses
{
	# ...
	
	public function restObject( $obj )
	{
		global $Events;
		$obj = (object) $obj;
		$event = $Events->forId($obj->event_id);
		$event = $Events->restObject($event);
		if(!$obj->show_dates) $obj->show_dates = "kNo";
		if(!$obj->is_multiple) $obj->is_multiple = "kNo";
		$obj->dates = $event->dates;
		return $obj;
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
	public function delete($id)
	{
		$query	= "DELETE FROM {$this->tb} WHERE id='{$id}'";
		$this->db->query($query);
	}
	
	# ...
	
	public function events()
	{
		$ev1 = array("id" => "99", "slug" => "damodaran14", "label" => "Seminário HSM - Damodaran on Valuation");
		$ev2 = array("id" => "100", "slug" => "gestao14", "label" => "Fórum HSM - Gestão e Liderança 2014");
		$ev3 = array("id" => "101", "slug" => "familybiz14", "label" => "Fórum HSM - Family Business 2014");
		
		return array((object) $ev1, (object) $ev2, (object) $ev3);
	}
	public function colors()
	{
		$ev1 = array("slug" => "green", "label" => "Passe Single");
		$ev2 = array("slug" => "gold", "label" => "Passe Premium");
		$ev3 = array("slug" => "red", "label" => "Passe Corporate");
		
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