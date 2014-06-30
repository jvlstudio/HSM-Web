<?php 

define(	"KEY_APP", 		"app" );
define(	"KEY_EVENTS",	"events" );
define(	"KEY_CATEGORIES","categories" );
define(	"KEY_VENUES",	"venues" );
define(	"KEY_FEATURED",	"featured" );

class Versions 
{	
	private $json;
	private $data;
	private $file;
	private $fileName;
	
	public function __construct( $path )
	{
		$this->json		= NULL;
		$this->data		= NULL;
		$this->file		= NULL;
		$this->fileName	= "{$path}/json/versions.json";
	}
	
	public function getVersionForKey($key)
	{
		$file 	= $this->get();
		$data	= (array) $file->data;
		return $data[$key];
	}
	
	public function updateVersionForKey($key)
	{
		$file 	= $this->get();
		$data	= (array) $file->data;
		
		$obj				= array();
		$obj[KEY_APP]		= $data[KEY_APP];
		$obj[KEY_EVENTS]	= $data[KEY_EVENTS];
		$obj[KEY_CATEGORIES]= $data[KEY_CATEGORIES];
		$obj[KEY_VENUES]	= $data[KEY_VENUES];
		$obj[KEY_FEATURED]	= $data[KEY_FEATURED];
		
		$obj[$key]			= floatval($data[$key]) + 0.1;
		
		$newdata			= new stdClass;
		$newdata->data		= (object) $obj;
		$this->json			= json_encode($newdata);
		
		$this->save();
	}
	
	public function get()
	{
		$this->file = file_get_contents($this->fileName);
		$this->json	= $this->file;
		$this->data = json_decode($this->json);
		return $this->data;
	}
	
	private function save()
	{
		$fh = fopen($this->fileName, 'w') or die("Não foi possível ler o arquivo de versões.");
		fwrite($fh, $this->json);
		fclose($fh);
	}
	
	public function printIt()
	{
		$data = $this->get();
		pre($data);
	}
}

if(!isset($path)) $path = "";
$Versions = new Versions( $path );

?>