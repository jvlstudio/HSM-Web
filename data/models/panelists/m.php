<?php 

interface iPanelists
{
	public function select($param="");
	public function get($param="");
	public function forId($id, $param="");
	public function forKey($value, $key="id");
	public function forEvent($event_id);
	public function delete($id);
}

class Panelists extends Functions implements iPanelists
{
	# ...
	
	public function restObject( $obj )
	{
		$obj = (object) $obj;
		$obj->picture = "http://apps.ikomm.com.br/hsm5/panelists/{$obj->picture}";
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
		$query	= "SELECT * FROM {$this->tb} {$param}";
		$res	= $this->db->result($query);
		$obj	= (object) $res;
		return $obj;
	}
	public function forId( $id, $param="" )
	{
		$res	= $this->get("WHERE id='{$id}' {$param}");
		return $res;
	}
	public function forKey( $value, $key="id" )
	{
		$res	= $this->get("WHERE {$key}='{$value}'");
		return $res;
	}
	public function forEvent($event_id)
	{
		$res	= $this->select("WHERE event_id='{$event_id}'");
		return $res;
	}
	public function delete($id)
	{
		$query	= "DELETE FROM {$this->tb} WHERE id='{$id}'";
		$this->q($query);
	}
}

?>