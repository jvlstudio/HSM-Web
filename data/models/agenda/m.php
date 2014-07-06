<?php 

interface iAgenda
{
	public function select($param="");
	public function get($param="");
	public function forId($id, $param="");
	public function forKey($value, $key="id");
	public function forEvent($event_id);
	public function forPanelist($panelist_id);
	public function delete($id);
	# ...
	public function types();
	public function hourFor($obj);
}

class Agenda extends Functions implements iAgenda
{
	# ...
	
	public function restObject( $obj )
	{
		global $Events, $Panelists;
		
		$obj = (object) $obj;
	
		$rest			= new stdClass;
		$event			= $Events->forId($obj->event_id);
		$panelist		= $Panelists->forId($obj->panelist_id);
		$dates			= $Events->datesFrom($event);
		
		$_event			= new stdClass;
		$_event->id		= $event->id;
		$_event->name	= $event->name;
		$_event->slug	= $event->slug;
		
		$_theme			= new stdClass;
		$_theme->title	= $obj->theme_title;
		$_theme->description = $obj->theme_description;
		
		$_pan			= new stdClass;
		$_pan->id		= $panelist->id;
		$_pan->name		= $panelist->name;
		$_pan->slug		= $panelist->slug;
		$_pan->picture	= "http://apps.ikomm.com.br/hsm5/uploads/panelists/{$panelist->picture}";
		$_pan->description = $panelist->description;
		$_pan->theme_title	= $_theme->title;
		$_pan->theme_description = $_theme->description;
		
		$_date			= new stdClass;
		$_date->id		= $obj->date;
		$_date->date	= $dates[$obj->date];
		$_date->start	= $obj->date_start;
		$_date->end		= $obj->date_end;
		
		$_pan->date		= $_date;
		
		# rest..
		$rest->id		= $obj->id;
		$rest->type		= $obj->type;
		$rest->event	= $_event;
		$rest->date		= $_date;
		$rest->label	= $obj->label;
		$rest->sublabel	= $obj->sublabel;
		
		if ($obj->type == "speech") {
			$rest->panelist = $_pan;
			$rest->label	= $panelist->name;
			$rest->sublabel	= $obj->theme_title;
		}
		
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
	public function forEvent($event_id)
	{
		$res	= $this->select("WHERE event_id='{$event_id}' ORDER BY `date` ASC");
		return $res;
	}
	public function forPanelist($panelist_id)
	{
		$res	= $this->select("WHERE panelist_id='{$panelist_id}'");
		return $res;
	}
	public function delete($id)
	{
		$query	= "DELETE FROM {$this->tb} WHERE id='{$id}'";
		$this->q($query);
	}
	
	# ...
	
	public function types()
	{
		$keys	= array("speech", "break", "session");
		$labels	= array("Palestra", "Pausa", "Sessão especial");
		$array	= array();
		
		for ($i = 0; $i < count($keys); $i++) {
			$obj = new stdClass;
			$obj->key	= $keys[$i];
			$obj->label	= $labels[$i];
			$array[] = $obj;
		}
		
		return $array;
	}
	public function hourFor($obj)
	{
		$x1 = explode(" ", $obj->date_start);
		$x2 = explode(" ", $obj->date_end);
		$hour = new stdClass;
		$hour->start = substr($x1[1], 0, 5);
		$hour->end   = substr($x2[1], 0, 5);
		return $hour;
	}
}

?>