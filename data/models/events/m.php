<?php 

interface iEvents
{
	public function select($param="");
	public function get($param="");
	public function forId($id, $param="");
	public function forKey($value, $key="id");
	# ...
	public function deleteItem($id);
	# ...
	public function datesFrom( $obj );
}

class Events extends Functions implements iEvents
{
	# ...
	
	public function restObject( $obj )
	{
		$obj = (object) $obj;
	
		$rest			= new stdClass;
		$dates			= $this->datesFrom($obj);
		$_dates			= array();
		
		for($i=0; $i < count($dates); $i++):
			$_date			= new stdClass;
			$_date->id		= $i;
			$_date->date	= $dates[$i];
			$_dates[]		= $_date;
		endfor;
		
		# rest..
		$rest->id		= $obj->id;
		$rest->name		= $obj->name;
		$rest->slug		= $obj->slug;
		$rest->description = $obj->description;
		$rest->tiny_description = $obj->tiny_description;
		$rest->dates	= $dates;
		$rest->date_pretty = $this->datePretty($dates);
		$rest->hours	= $obj->info_hours;
		$rest->locale	= $obj->info_locale;
		
		# images
		$images			= new stdClass;
		$images->list	= $this->completeURL($obj->image_list);
		$images->single	= $this->completeURL($obj->image_single);
		$rest->images	= $images;
		
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
	
	# ...
	
	public function deleteItem($id)
	{
		$obj 	= $this->forId($id);
		if ($obj->picture)
			@unlink("../uploads/events/{$obj->picture}");
		# events..
		$query	= "DELETE FROM {$this->tb} WHERE id='{$id}'";
		$this->db->query($query);
		# passes..
		$query2	= "DELETE FROM `passes` WHERE event_id='{$id}'";
		$this->db->query($query2);
		# agenda..
		$query3	= "DELETE FROM `agenda` WHERE event_id='{$id}'";
		$this->db->query($query3);
	}
	
	# ...
	
	public function datesFrom( $obj )
	{
		$dates = explode("|", $obj->info_dates);
		return $dates;
	}
	
	private function datePretty( $array )
	{
		$str = "";
		$dates = array();
		$month = "";
		foreach ($array as $string) {
			$dx = explode("/", $string);
			$dates[] = $dx[0];
			$month = $dx[1];
		}
		$str = implode(", ", $dates);
		$str .= " ".$this->month($month);
		return $str;
	}
	private function month($value)
	{
		$str = "";
		switch ($value) {
			case "01": $str = "jan"; break;
			case "02": $str = "fev"; break;
			case "03": $str = "mar"; break;
			case "04": $str = "abr"; break;
			case "05": $str = "mai"; break;
			case "06": $str = "jun"; break;
			case "07": $str = "jul"; break;
			case "08": $str = "ago"; break;
			case "09": $str = "set"; break;
			case "10": $str = "out"; break;
			case "11": $str = "nov"; break;
			case "12": $str = "dez"; break;
		}
		return $str;
	}
	
	# private
	
	private function completeURL( $uri )
	{
		$url = "http://apps.ikomm.com.br/hsm5/uploads/events/";
		return $url.$uri;
	}
}

?>