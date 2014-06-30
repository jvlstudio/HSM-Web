<?php
# ..
# file..
$file 	= (!isset($file_name) ? $_FILES["excel"] : $file_name);
$time	= (!isset($time) ? true : $time);

# ..
# vars..
$excel		= "";
$uploaddir	= "../uploads/excel/";
$prefix		= "events_".date("Ymd")."_";

# ..
# process (excel)..
if( $file["name"] != "" )
{
	if ($err<1) 
	{
		# name..
		# ...
		if (preg_match("/(.*).(xls|XLS)/", $file["name"], $matches)) 
		{
			array_shift($matches);
			if($time)
				$matches[0] = $prefix.time().$sufix;
			else
				$matches[0] = $prefix.$sufix;
			$excel = implode(".", $matches);
		} 
		else 
		{
			$message = "O tipo de arquivo que você subiu não é um válido. Por favor, carregue somente excel.";
			die($message);
		}
		
		# move..
		# ...
		if(!move_uploaded_file( $file["tmp_name"], $uploaddir.$file["name"]) )
		{
			$message = "Não foi possível carregar este arquivo.";
			die($message);
		}
		else
		{
			chmod($uploaddir.$file["name"], 0644);
			rename($uploaddir.$file["name"], $uploaddir.$excel);
		}
	}
}
?>