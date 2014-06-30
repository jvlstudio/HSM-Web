<?php 

interface iHome
{
	public function get();
}

class Home extends Functions implements iHome
{
	# ...
	
	public function get()
	{
		$res	= $this->db->result("SELECT * FROM {$this->tb}");
		$obj	= (object) $res;
		return $obj;
	}
}

?>