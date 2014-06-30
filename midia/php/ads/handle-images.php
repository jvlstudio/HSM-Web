<?php

# ..
# file..
$file = (!isset($file_name) ? $_FILES["picture"] : $file_name);

# ..
# vars..
$image		= "";
$uploaddir	= "../uploads/ads/";

# ..
# process (image)..
if( $file["name"] != "" )
{
	if (preg_match("/(.*).(jpg|gif|jpeg|png|JPG|JPEG|GIF|PNG)/", $file["name"], $matches)) 
	{
		array_shift($matches);
		$matches[0] = $prefix.time().$sufix;
		$image = implode(".", $matches);
	} 
	else 
	{ die("O tipo de arquivo que você subiu não é um válido. Por favor, carregue somente imagens."); }
	
	// ...
	if(!move_uploaded_file( $file["tmp_name"], $uploaddir.$file["name"]) )
	{ die("Não foi possível carregar este arquivo."); }
	else
	{
		chmod($uploaddir.$file["name"], 0644);
		rename($uploaddir.$file["name"], $uploaddir.$image);
	}
}

?>