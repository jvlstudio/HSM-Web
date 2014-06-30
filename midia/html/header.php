<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8" />
<title id="meta_title"></title>
<!-- meta -->
<meta name="language" content="pt-br" />
<meta name="robots" content="nofollow,noindex,noarchive" />
<meta name="title" content="" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<!-- css -->
<link href="<?php echo BACKEND_CSS;?>/reset.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo BACKEND_CSS;?>/stylesheet.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo BACKEND_CSS;?>/utils.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo BACKEND_CSS;?>/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" media="all" />
<!-- jquery -->
<script type="text/javascript">
	var handle_url = "<?php echo HOST;?>";
</script>
<script type="text/javascript" src="<?php echo BACKEND_JS;?>/jquery.js"></script>
<script type="text/javascript" src="<?php echo BACKEND_JS;?>/jquery-delay.js"></script>
<script type="text/javascript" src="<?php echo BACKEND_JS;?>/jquery-input-counter.js"></script>
<script type="text/javascript" src="<?php echo BACKEND_JS;?>/jquery-validate.js"></script>
<script type="text/javascript" src="<?php echo BACKEND_JS;?>/jquery-mask.js"></script>
<script type="text/javascript" src="<?php echo BACKEND_JS;?>/jquery-money.js"></script>
<!-- tipsy -->
<script src="<?php echo BACKEND_JS;?>/tipsy/javascripts/jq.tipsy.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo BACKEND_JS;?>/tipsy/stylesheets/tipsy.css" />
<!-- ui -->
<script type="text/javascript" src="<?php echo BACKEND_JS;?>/jquery-ui/development-bundle/ui/jquery-ui.custom.js"></script>
<script type="text/javascript" src="<?php echo BACKEND_JS;?>/jquery-ui/development-bundle/ui/jquery.ui.datepicker.js"></script>
<link href="<?php echo BACKEND_JS;?>/jquery-ui/development-bundle/themes/flick/jquery-ui.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo BACKEND_JS;?>/jquery-ui/development-bundle/themes/flick/jquery.ui.datepicker.css" rel="stylesheet" type="text/css" media="all" />
<!-- event calendar -->
<link href='<?php echo BACKEND_JS;?>/fullcalendar/fullcalendar/fullcalendar.css' rel='stylesheet' />
<link href='<?php echo BACKEND_JS;?>/fullcalendar/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='<?php echo BACKEND_JS;?>/fullcalendar/fullcalendar/fullcalendar.min.js'></script>
<!-- /ui 
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApVkL5Abeee4Byjv2dhoKMwEsDZZen8eA&sensor=false"></script>-->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<!-- scripts -->
<script type="text/javascript" src="<?php echo BACKEND_JS;?>/scripts.js"></script>
	
</head>
<body>

<div id="logo"></div>

<?php
# menu
global $args;
if($args->dir != "sign")
get_menu(''); ?>

<div id="content">