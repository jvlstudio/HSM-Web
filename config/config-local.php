<?php 

//$http = ( $_SERVER["HTTPS"] == "on" ? "https://" : "http://" );
$http	= "http://";

/* titulos */
define("ROOT", "/IKOMM/apps/hsm5");
define("SERVER_ROOT", "".ROOT);
define("DOMAIN", "localhost");
define("HOST", $http.DOMAIN.ROOT);

/* mysql db */
$defaults = array( 	"host" => "localhost",
					"name" => "hsm5",
					"user" => "root",
					"pass" => ""); //server */

$config = (object) $defaults;

?>