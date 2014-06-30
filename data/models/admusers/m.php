<?php 

interface iAdmUsers
{
	# basic..
	public function select($param="");
	public function get($param="");
	public function forId($id, $param="");
	public function forKey($value, $key="id");
	public function isRegistered($key, $value);
	public function delete($id);
	public function sign($user, $pass);
}

class AdmUsers extends Functions implements iAdmUsers
{
	# users
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
		return $res;
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
	public function isRegistered($key, $value)
	{
		$query	= "SELECT COUNT(id) AS total FROM {$this->tb} WHERE {$key}='{$value}'";
		$res	= (object) $this->db->result($query);
		return ($res->total > 0);
	}
	public function delete($id)
	{
		// ..
		$query	= "DELETE FROM {$this->tb} WHERE id='{$id}'";
		$this->db->query($query);
	}
	public function sign($user, $pass)
	{
		$query	= "SELECT id FROM {$this->tb} WHERE username='{$user}' AND password='{$pass}'";
		$res	= $this->db->results($query);
		if (count($res) > 0)
			return true;
		else
			return false;
	}
}

?>