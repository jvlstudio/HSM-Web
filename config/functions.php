<?php

$now			= @date("Y-m-d H:i:s");
$crypt_key		= "ricierime";

$val_checked	= "checked=\"checked\"";
$val_selected	= "selected=\"selected\"";

# -----------------------------------
# FUNCTIONS
# -----------------------------------

# is logged
function is_logged($dir="backend")
{
	@session_start();
	$me = (object) $_SESSION['user'];
	if (empty($me->id))
		return_inside("/{$dir}/sign");
}

# -pre 
function pre($s,$d=false)
{
	echo '<pre>'; print_r($s); echo '</pre>';
	if($d) die();
}
function minimumLabel($string, $count=10)
{
	$s = $string;
	if(strlen($string) > $count):
		$s  = substr($string, 0, $count);
		$s .= "...";
	endif;
	return $s;
}

# -return_to_login
# redirs user to login
function return_to($host)
{
	echo '<script type="text/javascript">window.location="'.$host.'";</script>';
}
function return_inside($host)
{
	echo '<script type="text/javascript">window.location="'.ROOT.$host.'";</script>';
}
function permalink($str, $canEcho=true)
{
	$s = ROOT.$str;
	if($canEcho)
		echo $s;
	else 
		return $s;
}

# title..
function title($str)
{
	echo "<script type=\"text/javascript\">$('#meta_title').text('{$str}');</script>";
}

# -translate url
# read url and gives an array
# with args
function translate_url($url, $home="home")
{
	# process
	$urlx 	= explode("/", $url);
	# vars
	$dir	= empty($urlx[0]) ? $home	: $urlx[0];
	$page	= empty($urlx[1]) ? 'index'	: $urlx[1];
	$id		= isset($urlx[2]) ? $urlx[2] : "";
	# package
	$arr	=  array("dir"	=> $dir,
					 "page" => $page,
					 "id"	=> $id );
	# return
	return (object) $arr;
}

#
# -read_apps
function read_apps($str_path="/data/models/")
{
	global $path;
	$data = array();
	# diretorio de apps
	$DIR = dir( $path . $str_path );
	while (false !== ($entry = $DIR->read())):
		//echo $entry . '<br/>';
		if( $entry != 'database' 
		&& 	strlen($entry) > 2 
		&& 	false === strpos($entry,'+') 
		&& 	false === strpos($entry,'.') 
		//&& $entry != '4oh4.php' 
		//&& $entry != 'log'
		):
			$data[] = $entry;
		endif;
	endwhile;
	$DIR->close(); // end */
	
	return $data;
}

function dateObject($datetime)
{
	$d 		= new stdClass;
	$d1		= explode(" ", $datetime);	// date x hour
	$d2		= explode("-", $d1[0]);		// date
	$d3		= explode(":", $d1[1]);		// hour
	
	$d->day		= $d2[2];
	$d->month	= $d2[1];
	$d->year	= $d2[0];
	$d->hour	= $d3[0];
	$d->minute	= $d3[1];
	$d->second	= $d3[2];
	
	return $d;
}

# -----------------------------------
# TPL PARTS
# -----------------------------------

# -get_html
function get_html($string, $f="")
{
	include( "{$f}html/{$string}.php" );
}

# -get_php
function get_php($string)
{
	global $args;
	$f = $args->dir;
	include( "php/{$f}/{$string}.php" );
}
function get_source($source)
{
	global $args;
	include( "php/{$args->dir}/{$source}.php" );
}

# -get header
function get_header($f="frontend/",$prop="")
{
	global $args;
	include( "{$f}html/header{$prop}.php" );
}

function get_menu($f="frontend/",$prop="")
{
	global $args;
	include( "{$f}html/menu{$prop}.php" );
}
function get_modal($f="frontend/",$prop="")
{
	global $args;
	include( "{$f}html/modal{$prop}.php" );
}
function get_footer($f="frontend/", $prop="")
{
	global $args;
	include( "{$f}html/footer{$prop}.php" );
}

function hex2rgb($hex)
{
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}
function rgb2hex($rgb)
{
   $hex = "#";
   $hex .= str_pad(dechex($rgb[0]), 2, "0", STR_PAD_LEFT);
   $hex .= str_pad(dechex($rgb[1]), 2, "0", STR_PAD_LEFT);
   $hex .= str_pad(dechex($rgb[2]), 2, "0", STR_PAD_LEFT);

   return $hex; // returns the hex value including the number sign (#)
}

# -----------------------------------
# EN/DECRYPT (GRAPH)
# -----------------------------------

function jsonWithSuccess($info)
{
	$data->data 	= $info;
	$data->success	= 1;
	
	$out = (!$_GET['output'] ? "json" : $_GET['output']);
	output($data, $out);
}
function jsonWithError($message)
{
	$data->message 	= $message;
	$data->success	= 0;
	
	$out = (!$_GET['output'] ? "json" : $_GET['output']);
	output($data, $out);
}

# output
function output($data, $output="json")
{
	if($output != "json")
	{
		pre($data, true);
	}
	else {
		@header('Cache-Control: no-cache, must-revalidate');
		@header('Content-type: application/json');
		@header('Access-Control-Allow-Origin: http://curitibaapresenta.com.br');
		echo json_encode($data); 
		die();
	}
}

?>