<?php 

//$http = ( $_SERVER["HTTPS"] == "on" ? "https://" : "http://" );
$http	= "http://";

/* titulos */
define("ROOT", "/hsm5");
define("SERVER_ROOT", "/home/brand947/subdomains/ikomm.apps".ROOT);
define("DOMAIN", "apps.ikomm.com.br");
define("HOST", $http.DOMAIN.ROOT);

/* mysql db */
$defaults = array( 	"host" => "localhost",
					"name" => "brand947_apphsm5",
					"user" => "brand947_apps",
					"pass" => "db!apps"); //server */

$config = (object) $defaults;

?>