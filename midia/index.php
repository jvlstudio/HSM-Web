<?php

# requiring
$path = '..';
require_once("../config/ini.php");
@session_start();

# constructing website
# translate_url() will include the right module
# for the request made by the user.
$args 	= translate_url( $_GET['args'] );

# login..
if ($args->dir != 'sign')
	is_logged("midia");
	
# user..
$me = $_SESSION['user'];

# 404
if($args->dir == '4oh4'):
	include( FRONTEND.BAR.PHP."/4oh4.php" );
	die();
endif;

# target_id
# the third parameter is the global target id.
$target_id = $args->id;

# include
if( !include_once( "php/{$args->dir}/{$args->page}.php" ) ):
	if ($args->dir == "home")
		return_inside('/midia/clients');
endif;

/**
 * 	@author	Felipe Ricieri
 *	@version	2.0.3
 *
 	Este arquivo pode conter informações sigilosas, assim como conteúdo, tokens, encrtipitações e derivados. 
 	Não é permitido a divulgação destas informações. Ao lê-las, você concorda em não reproduzí-las, arcando com os consequências jurídicas e penais.
 		
 	@ 2011-2013 - Todos os direitos reservados.
 *
 **/

?>