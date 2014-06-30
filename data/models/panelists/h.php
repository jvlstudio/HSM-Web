<?php 

if(!isset($path)) $path = "..";
$slug = "panelists";
$root = SERVER_ROOT;

# paths
$path_db	= $path."/data/models/{$slug}/db.sql";
$path_m		= $path."/data/models/{$slug}/m.php";
# db
$tb 		= file_get_contents( $path_db );
$tbl_arr	= explode(TBL_DELIMITER, $tb);
# implementation
require_once( $path_m );


class kPanelists extends Panelists
{
	protected $db;		# database
	protected $tbc;		# default
	
	protected $tb;
	
	public function __construct( $db, $root )
	{
		$this->db		= $db;
		$this->tb 		= "panelists";
		$this->tbc		= $this->tb;
		
		global $tbl_arr, $slug;
		$this->app( $this->tb, $tbl_arr, $slug );
	}
	
	public function table($case)
	{
		return $case;
	}
	
	public function setTable($tb)
	{
		$this->tbc = $this->table($tb);
	}
}

# instance
$Panelists = new kPanelists( $Db, $root );

?>