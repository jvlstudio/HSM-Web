<?php 

require_once( $path . "/config/config.php");

# keys > paths

define(	"PATH_SERVER", 			"/var/www/html" );
define(	"PATH", 				PATH_SERVER . "/apps" );
define(	"PATH_UTILS", 			PATH_SERVER . "/utils" );

# keys > social
# ....

define(	"FACEBOOK",				"http://fb.me/" );
define(	"TWITTER",				"http://twitter.com/" );
define(	"INSTAGRAM",			"http://instagram.com/" );

define(	"FACEBOOK_APP_ID",		"" );
define(	"FACEBOOK_APP_SECRET",	"" );
define(	"FACEBOOK_APP_PERMS",	"publish_stream,email,read_friendlists,publish_actions" );
define( "FACEBOOK_SDK",			PATH_UTILS . "/facebook/api/src/facebook.php" );

# keys > apple

define( "APPLE_TEAM_ID", 		"E5H57675F4" );
define( "APPLE_PERSON_ID", 		"1279046580" );

# keys > system
# ....

define(	"TBL_DELIMITER", 		"--NODE--" );
define(	"GLUE_DELIMITER", 		"j3ssM4rq201088" );
define(	"BAR", 					"/" );

# keys > directories
# ....

define(	"DIR_BACKEND", 			"backend" );
define(	"DIR_FRONTEND", 		"frontend" );
define(	"DIR_PAINEL",	 		"painel" );
define(	"DIR_APPS", 			"apps" );
define(	"DIR_UTILS", 			"utils" );
define(	"DIR_BLOG", 			"blog" );
define(	"DIR_CONFIG", 			"config" );
define(	"DIR_UPLOADS", 			"uploads" );
define(	"DIR_MODELS", 			"models" );

define(	"DIR_CSS", 				"css" );
define(	"DIR_JS", 				"js" );
define(	"DIR_HTML", 			"html" );
define(	"DIR_PHP", 				"php" );
define(	"DIR_IMAGES", 			"images" );
define(	"DIR_FONTS", 			"fonts" );
define(	"DIR_DATA", 			"data" );
define(	"DIR_SOURCES", 			"sources" );
define(	"DIR_SYS", 				"sys" );
define(	"DIR_TPL", 				"tpl" );

# keys > shortcuts
# obs.: the "HOST" constant should be set previously
# ....

define(	"HOST_BACKEND", 		HOST.BAR.DIR_BACKEND );
define(	"HOST_FRONTEND", 		HOST.BAR.DIR_FRONTEND );
define(	"HOST_APPS", 			"http://utils.ikomm.com.br" );
define(	"HOST_UPLOADS", 		HOST.BAR.DIR_UPLOADS );
define( "HOST_PAINEL",			HOST.BAR.DIR_PAINEL );

define(	"FRONTEND_CSS", 		HOST.BAR.DIR_FRONTEND.BAR.DIR_CSS);
define(	"FRONTEND_JS",	 		HOST.BAR.DIR_FRONTEND.BAR.DIR_JS);
define(	"FRONTEND_HTML", 		HOST.BAR.DIR_FRONTEND.BAR.DIR_HTML);
define(	"FRONTEND_PHP", 		HOST.BAR.DIR_FRONTEND.BAR.DIR_PHP);
define(	"FRONTEND_IMAGES", 		HOST.BAR.DIR_FRONTEND.BAR.DIR_IMAGES);

define(	"BACKEND_CSS", 			HOST.BAR.DIR_BACKEND.BAR.DIR_CSS);
define(	"BACKEND_JS",	 		HOST.BAR.DIR_BACKEND.BAR.DIR_JS);
define(	"BACKEND_HTML", 		HOST.BAR.DIR_BACKEND.BAR.DIR_HTML);
define(	"BACKEND_PHP", 			HOST.BAR.DIR_BACKEND.BAR.DIR_PHP);
define(	"BACKEND_IMAGES", 		HOST.BAR.DIR_BACKEND.BAR.DIR_IMAGES);

define(	"PAINEL_CSS", 			HOST.BAR.DIR_PAINEL.BAR.DIR_CSS);
define(	"PAINEL_JS",	 		HOST.BAR.DIR_PAINEL.BAR.DIR_JS);
define(	"PAINEL_HTML", 			HOST.BAR.DIR_PAINEL.BAR.DIR_HTML);
define(	"PAINEL_PHP", 			HOST.BAR.DIR_PAINEL.BAR.DIR_PHP);
define(	"PAINEL_IMAGES", 		HOST.BAR.DIR_PAINEL.BAR.DIR_IMAGES);

# keys > server
# ....

define(	"HTTP_POST", 			$_SERVER['HTTP_HOST']);		# domain.com.br
define(	"REQUEST_URI", 			$_SERVER['REQUEST_URI']);	# /index.php

?>