<?php 

if(!isset($path)) $path = "..";
$slug = "home";
$root = SERVER_ROOT;

# paths
$path_db	= $path."/data/models/{$slug}/db.sql";
$path_m		= $path."/data/models/{$slug}/m.php";
# db
$tb 		= file_get_contents( $path_db );
$tbl_arr	= explode(TBL_DELIMITER, $tb);
# implementation
require_once( $path_m );


class kHome extends Home
{
	protected $db;		# database
	protected $tbc;		# default
	
	protected $tb;
	
	public function __construct( $db, $root )
	{
		$this->db		= $db;
		$this->tb 		= "home";
		$this->tbc		= $this->tb;
		
		global $tbl_arr, $slug;
		$this->app( $this->tb, $tbl_arr, $slug );
	}
}

# instance
$Home = new kHome( $Db, $root );

?>