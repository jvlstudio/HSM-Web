<?php

# ..
# file..
$file 	= (!isset($file_name) ? $_FILES["picture"] : $file_name);
$time	= (!isset($time) ? true : $time);
$dir	= (!isset($dir) ? "events" : $dir);

# ..
# vars..
$image		= "";
$uploaddir	= "../uploads/{$dir}";

# ..
# process (image)..
if( $file["name"] != "" )
{
	# image sizes..
	# ...
	$image_info 	= getimagesize($file["tmp_name"]);
	$image_width 	= $image_info[0];
	$image_height 	= $image_info[1];
	
	if ((isset($max_width) && isset($max_height))
	&&  ($image_width != $max_width || $image_height != $max_height)){
		die("O tamanho da(s) imagem(ns) inserida(s) ultrapassa o valor máximo informado.");
	}

	if ($err<1) 
	{
		# name..
		# ...
		if (preg_match("/(.*).(png|PNG)/", $file["name"], $matches)) 
		{
			array_shift($matches);
			if($time)
				$matches[0] = $prefix.time().$sufix;
			else
				$matches[0] = $prefix.$sufix;
			$image = implode(".", $matches);
		} 
		else {
			die("O tipo de arquivo que você carregou não é um válido. Por favor, carregue somente imagens PNG.");
		}
		
		# move..
		# ...
		if(!move_uploaded_file( $file["tmp_name"], $uploaddir.$file["name"]) )
		{
			die("Não foi possível carregar este arquivo.");
		}
		else {
			chmod($uploaddir.$file["name"], 0644);
			rename($uploaddir.$file["name"], $uploaddir.$image);
		}
	}
}

?>