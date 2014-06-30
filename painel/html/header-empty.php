<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8" />
<title id="meta_title">HSM - App Manager</title>
<!-- meta -->
<meta name="language" content="pt-br" />
<meta name="robots" content="nofollow,noindex,noarchive" />
<meta name="title" content="HSM - App Manager" />
<meta name="description" content="" />
<meta name="keywords" content="guia, curitiba, fundação cultural, eventos, cidade" />
<!-- css -->
<link href="<?php echo BACKEND_CSS;?>/reset.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo PAINEL_CSS;?>/stylesheet.css" rel="stylesheet" type="text/css" media="all" />
<?php 
if($args->dir == "sign"): ?>
<link href="<?php echo PAINEL_CSS;?>/login.css" rel="stylesheet" type="text/css" media="all" />
<?php 
endif; ?>
<link href="<?php echo BACKEND_CSS;?>/utils.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo BACKEND_CSS;?>/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" media="all" />
<link href='http://fonts.googleapis.com/css?family=Arvo:400,700' rel='stylesheet' type='text/css'>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,300,400italic,400,600italic,600,700italic,700,800italic,800" rel="stylesheet" type="text/css">
<!-- jquery -->
<script type="text/javascript">
	var domain		= "<?php echo HOST;?>",
		site_url 	= domain + "/painel",
		uploads_url	= domain + "/uploads",
		model	 	= "<?php echo $args->dir;?>",
		page		= "<?php echo $args->page;?>",
		token		= "<?php echo $me->id;?>",
		target		= "<?php echo $args->id;?>";
</script>
<script type="text/javascript" src="<?php echo BACKEND_JS;?>/jquery.js"></script>
<script type="text/javascript" src="<?php echo BACKEND_JS;?>/jquery-validate.js"></script>
<script type="text/javascript" src="<?php echo BACKEND_JS;?>/jquery-mask.js"></script>
<script type="text/javascript" src="<?php echo BACKEND_JS;?>/jquery-money.js"></script>
<script type="text/javascript" src="<?php echo BACKEND_JS;?>/jquery-delay.js"></script>
<script type="text/javascript" src="<?php echo BACKEND_JS;?>/jquery-customSelect.js"></script>
<script type="text/javascript" src="<?php echo BACKEND_JS;?>/jquery-tinysort.js"></script>
<!-- tipsy -->
<script src="<?php echo BACKEND_JS;?>/tipsy/javascripts/jq.tipsy.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo BACKEND_JS;?>/tipsy/stylesheets/tipsy.css" />
<!-- colorpicker -->
<script src="<?php echo BACKEND_JS;?>/farbtastic/farbtastic.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo BACKEND_JS;?>/farbtastic/farbtastic.css" />
<!-- ui -->
<script type="text/javascript" src="<?php echo BACKEND_JS;?>/jquery-ui/development-bundle/ui/jquery-ui.custom.js"></script>
<script type="text/javascript" src="<?php echo BACKEND_JS;?>/jquery-ui/development-bundle/ui/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="http://jquery-ui.googlecode.com/svn/!svn/bc/3982/trunk/ui/i18n/jquery.ui.datepicker-pt-BR.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link href="<?php echo BACKEND_JS;?>/jquery-ui/development-bundle/themes/flick/jquery-ui.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo BACKEND_JS;?>/jquery-ui/development-bundle/themes/flick/jquery.ui.datepicker.css" rel="stylesheet" type="text/css" media="all" />
<!-- /ui -->
<script type="text/javascript" src="<?php echo PAINEL_JS;?>/isloaded.js"></script>
<script type="text/javascript" src="<?php echo PAINEL_JS;?>/scripts.js"></script>
<script type="text/javascript" src="<?php echo PAINEL_JS;?>/watermark.js"></script>
<script type="text/javascript" src="<?php echo PAINEL_JS;?>/fileinput.js"></script>
<?php if($args->page == "add" || $args->page == "edit"): ?>
<script type="text/javascript" src="<?php echo PAINEL_JS;?>/customSelectSetup.js"></script>
<?php endif; ?>
</head>
<body>
