<?php

global $Tb;

# file..
$prefix		= "image_panelist_";
$sufix		= "";
//$file 		= $_FILES["image"];
$document	= "";
$directory	= "../uploads/panelists/";

# process (image)..
if( $file["name"] )
{
	# name..
	# ...
	if (preg_match("/(.*).(jpg|png|jpeg|JPG|PNG|JPEG)/", $file["name"], $matches)) {
		array_shift($matches);
		$slug = $matches[0];
		$matches[0]  = $prefix;
		$matches[0] .= $Tb->permalink($slug, "_");
		$matches[0] .= "_".$time;
		$matches[0] .= "@2x";
		$document = implode(".", $matches);
	} 
	else {
		$message = "O tipo de arquivo que você subiu não é um válido. Por favor, carregue somente imagens.";
		die("<p>{$message}</p>");
	}
	
	# move..
	# ...
	if(!@move_uploaded_file( $file["tmp_name"], $directory.$file["name"]) ){
		$message = "Não foi possível carregar este arquivo.";
		die("<p>{$message}</p>");
	}
	else{
		@chmod($directory.$file["name"], 0644);
		@rename($directory.$file["name"], $directory.$document);
	}
}

?>