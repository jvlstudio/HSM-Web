<?php 

interface iMagazines
{
	public function select($param="");
	public function get($param="");
	public function forId($id, $param="");
	public function forKey($value, $key="id");
	# ...
	public function deleteItem($id);
}

class Magazines extends Functions implements iMagazines
{
	# ...
	
	public function restObject( $obj )
	{
		$obj = (object) $obj;
		$obj->picture = "http://apps.ikomm.com.br/hsm5/uploads/magazines/{$obj->picture}";
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
	
	# ...
	
	public function deleteItem($id)
	{
		$obj 	= $this->forId($id);
		if ($obj->picture)
			@unlink("../uploads/magazines/{$obj->picture}");
		$query	= "DELETE FROM {$this->tb} WHERE id='{$id}'";
		$this->db->query($query);
	}
}

?>