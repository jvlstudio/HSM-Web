<?php 

if(!isset($path)) $path = "..";
$slug = "ads";
$root = SERVER_ROOT;

# paths
$path_db	= $path."/data/models/{$slug}/db.sql";
$path_m		= $path."/data/models/{$slug}/m.php";
# db
$tb 		= file_get_contents( $path_db );
$tbl_arr	= explode(TBL_DELIMITER, $tb);
# implementation
require_once( $path_m );


class kAds extends Ads
{
	protected $db;		# database
	protected $tbc;		# default
	
	protected $tb, $tb_cam, $tb_cli, $tb_act, $tbmeta;
	
	public function __construct( $db, $root )
	{
		$this->db		= $db;
		
		$this->tb 		= "ads";
		$this->tb_cam	= "ads_campaigns";
		$this->tb_cli	= "ads_clients";
		$this->tb_act	= "ads_activity";
		$this->tbmeta	= "ads_meta";
		
		$this->tbc		= $this->tb;
		
		global $tbl_arr, $slug;
		$this->app( $this->tb, $tbl_arr, $slug );
	}
	
	public function table($case)
	{
		$r = "";
		switch($case):
			case '':
			case 'ads':			$r = $this->tb;		break;
			case 'campaigns':	$r = $this->tb_cam;	break;
			case 'clients':		$r = $this->tb_cli;	break;
			case 'activity':	$r = $this->tb_act;	break;
			
			case 'meta':		$r = $this->tbmeta;	 break;
			//
			default: 			$r = $this->tb;		 break;
		endswitch;
		
		return $r;
	}
	
	public function setTable($tb)
	{
		$this->tbc = $this->table($tb);
	}
}

# instance
$Ads = new kAds( $Db, $root );

?>