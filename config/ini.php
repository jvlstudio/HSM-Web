<?php 

# errors
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED);
//error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Brazil/East');

/* */
if( !isset($path) ) $path = "";
require_once( $path . "/config/vars.php" );
require_once( $path . "/config/functions.php" );

# apps
require_once( $path . BAR.DIR_DATA . "/Versions.php" );
require_once( $path . BAR.DIR_DATA . "/Functions.php" );
require_once( $path . BAR.DIR_DATA . "/DB.php" );

# diretorio de apps
$dirs = read_apps();
for ($i = 0; $i < count($dirs); $i++)
	require_once( $path . BAR.DIR_DATA.BAR.DIR_MODELS.BAR . $dirs[$i] . '/h.php' );

?>