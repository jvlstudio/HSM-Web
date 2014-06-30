<?php 

abstract class Functions 
{	
	/**
	 * Method: app
	 **/
	protected function app( $tb, $tbl, $slug )
	{
		#echo '<br/>'.$slug;
		if(!$this->isInstalled($this->tb)):
			if (isset($this->root) && isset($this->img)):
				if( !is_dir($this->root.$this->img) ):
					if(!empty($this->img)) $this->createFolder($this->root.'/'.$this->img);
				endif;
				
				if(count($tbl)>0){
					for( $b=0; $b<count($tbl); $b++ ):
						$this->install($tbl[$b]);
					endfor;
				} else { echo $slug.": vazio"; die(); }
			endif;
		endif;
	}
	
	/**
	 * Method: add, update, remove
	 **/
	public function add()
	{
		//pega argumentos..
		$args = func_get_args();
		$erros = "";
		
		$id = $this->createSQLElement($this->tbc);
		
		for($i=0;$i<func_num_args();$i++){
			$x = explode('=',$args[$i]);
			$x[1] = utf8_decode($x[1]);
			$query = "UPDATE {$this->tbc} SET `".$x[0]."`='".mysql_escape_string($x[1])."' WHERE id='{$id}' ";
			
			$this->db->q($query);
		}
		return $id;
	}
	
	public function update()
	{
		//pega argumentos..
		$args = func_get_args();
		$erros = "";
		
		for($i=1;$i<func_num_args();$i++){
			$x = explode('=',$args[$i]);
			$x[1] = utf8_decode($x[1]);
			$query = "UPDATE {$this->tbc} SET `{$x[0]}`='".mysql_escape_string($x[1])."' WHERE id='{$args[0]}' ";
			
			$this->db->q($query);
		}
		return true;
	}
	
	public function remove( $id, $row='id', $img=false )
	{
		if($img) $this->deleteFile($id);
		//query a ser executada
		$query = "DELETE FROM {$this->tbc} WHERE `{$row}`='{$id}'";

		//executando query ...
		if($this->db->q($query))
			return true;
		else 
			return false;
	}
	
	/**
	 * Method: metadata (select & get)
	 **/
	protected function selectMetaData($res, $table='')
	{
		$data	= array();
		$p		= 0;
		# ...
		if (!empty($table))
			$iftable = "AND `table`='{$table}'";
		# ...
		foreach($res as $arr):
			$obj 	= (object) $arr;
			$infos	= $this->db->results("SELECT * FROM {$this->tbmeta} WHERE parent_id='{$obj->id}' {$iftable}");
			$data[$p] = $arr;
			if(!empty($infos)):
				foreach($infos as $info):
					$info = (object) $info;
					$data[$p][$info->meta_key] = $info->meta_value;
				endforeach;
			endif;
			$p++;
		endforeach;
		return $data;
	}
	
	protected function getMetadata($res, $table='')
	{
		# ...
		if (!empty($table))
			$iftable = "AND `table`='{$table}'";
		# ...
		$obj	= (object) $res;
		$infos	= $this->db->results("SELECT * FROM {$this->tbmeta} WHERE parent_id='{$obj->id}' {$iftable}");
		$data 	= $res;
		if(!empty($infos)):
			foreach($infos as $info):
				$info = (object) $info;
				$data[$info->meta_key] = $info->meta_value;
			endforeach;
		endif;
		
		return $data;
	}
	
	/**
	 * Method: folders & files
	 **/
	
	public function install($query)
	{
		$this->db->q($query);
	}
	
	public function isInstalled($tabela="admins")
	{
		$tabelas = $this->db->listTables();
		$pointer = 0;
		
		for($t=0;$t<count($tabelas);$t++){
			if( $tabelas[$t] == $tabela ) $pointer++;
		}
		
		if($pointer==0) 	return false;
		else				return true;
	}
	
	protected function createSQLElement($tb,$row="id")
	{
		//query
		$query  = "INSERT INTO {$tb} ({$row}) VALUES (NULL)";
		$query2 = "SELECT {$row} FROM {$tb} ORDER BY {$row} DESC LIMIT 1";
		//fazemos..
		if($this->db->q($query)){
			//pega ultimo id..
			$xquery = $this->db->q($query2);
			$tmp = $this->db->fetchObj($xquery);
			$lastId = $tmp->id;
			return $lastId;
		}
		else {
			return false;
		}
	}
	
	protected function createFolder( $nome )
	{
		mkdir( $nome, 0777);
	}
	
	public function deleteFile( $folder, $img )
	{
		chmod($folder, 0777);
		if(!@unlink( $folder.$img )){
			echo 'Wasn\'t possible to delete this file.'; die();
			return false;
		}
		else { chmod($folder, 0755); return true; }
	}
	
	/**
	 * Sanitize: handle strings
	 *
	 * @method	remove_accents
	 * @method	sanitize_title_with_dashes
	 * @method	seems_utf8
	 * @method	utf8_uri_encode
	 * @method	capitalize
	 * @method	permalink
	 *
	 **/
	private function remove_accents($string) {
		if ( !preg_match('/[\x80-\xff]/', $string) )
			return $string;
	
		if ($this->seems_utf8($string)) {
			$chars = array(
			// Decompositions for Latin-1 Supplement
			chr(195).chr(128) => 'A', chr(195).chr(129) => 'A',
			chr(195).chr(130) => 'A', chr(195).chr(131) => 'A',
			chr(195).chr(132) => 'A', chr(195).chr(133) => 'A',
			chr(195).chr(135) => 'C', chr(195).chr(136) => 'E',
			chr(195).chr(137) => 'E', chr(195).chr(138) => 'E',
			chr(195).chr(139) => 'E', chr(195).chr(140) => 'I',
			chr(195).chr(141) => 'I', chr(195).chr(142) => 'I',
			chr(195).chr(143) => 'I', chr(195).chr(145) => 'N',
			chr(195).chr(146) => 'O', chr(195).chr(147) => 'O',
			chr(195).chr(148) => 'O', chr(195).chr(149) => 'O',
			chr(195).chr(150) => 'O', chr(195).chr(153) => 'U',
			chr(195).chr(154) => 'U', chr(195).chr(155) => 'U',
			chr(195).chr(156) => 'U', chr(195).chr(157) => 'Y',
			chr(195).chr(159) => 's', chr(195).chr(160) => 'a',
			chr(195).chr(161) => 'a', chr(195).chr(162) => 'a',
			chr(195).chr(163) => 'a', chr(195).chr(164) => 'a',
			chr(195).chr(165) => 'a', chr(195).chr(167) => 'c',
			chr(195).chr(168) => 'e', chr(195).chr(169) => 'e',
			chr(195).chr(170) => 'e', chr(195).chr(171) => 'e',
			chr(195).chr(172) => 'i', chr(195).chr(173) => 'i',
			chr(195).chr(174) => 'i', chr(195).chr(175) => 'i',
			chr(195).chr(177) => 'n', chr(195).chr(178) => 'o',
			chr(195).chr(179) => 'o', chr(195).chr(180) => 'o',
			chr(195).chr(181) => 'o', chr(195).chr(182) => 'o',
			chr(195).chr(182) => 'o', chr(195).chr(185) => 'u',
			chr(195).chr(186) => 'u', chr(195).chr(187) => 'u',
			chr(195).chr(188) => 'u', chr(195).chr(189) => 'y',
			chr(195).chr(191) => 'y',
			// Decompositions for Latin Extended-A
			chr(196).chr(128) => 'A', chr(196).chr(129) => 'a',
			chr(196).chr(130) => 'A', chr(196).chr(131) => 'a',
			chr(196).chr(132) => 'A', chr(196).chr(133) => 'a',
			chr(196).chr(134) => 'C', chr(196).chr(135) => 'c',
			chr(196).chr(136) => 'C', chr(196).chr(137) => 'c',
			chr(196).chr(138) => 'C', chr(196).chr(139) => 'c',
			chr(196).chr(140) => 'C', chr(196).chr(141) => 'c',
			chr(196).chr(142) => 'D', chr(196).chr(143) => 'd',
			chr(196).chr(144) => 'D', chr(196).chr(145) => 'd',
			chr(196).chr(146) => 'E', chr(196).chr(147) => 'e',
			chr(196).chr(148) => 'E', chr(196).chr(149) => 'e',
			chr(196).chr(150) => 'E', chr(196).chr(151) => 'e',
			chr(196).chr(152) => 'E', chr(196).chr(153) => 'e',
			chr(196).chr(154) => 'E', chr(196).chr(155) => 'e',
			chr(196).chr(156) => 'G', chr(196).chr(157) => 'g',
			chr(196).chr(158) => 'G', chr(196).chr(159) => 'g',
			chr(196).chr(160) => 'G', chr(196).chr(161) => 'g',
			chr(196).chr(162) => 'G', chr(196).chr(163) => 'g',
			chr(196).chr(164) => 'H', chr(196).chr(165) => 'h',
			chr(196).chr(166) => 'H', chr(196).chr(167) => 'h',
			chr(196).chr(168) => 'I', chr(196).chr(169) => 'i',
			chr(196).chr(170) => 'I', chr(196).chr(171) => 'i',
			chr(196).chr(172) => 'I', chr(196).chr(173) => 'i',
			chr(196).chr(174) => 'I', chr(196).chr(175) => 'i',
			chr(196).chr(176) => 'I', chr(196).chr(177) => 'i',
			chr(196).chr(178) => 'IJ',chr(196).chr(179) => 'ij',
			chr(196).chr(180) => 'J', chr(196).chr(181) => 'j',
			chr(196).chr(182) => 'K', chr(196).chr(183) => 'k',
			chr(196).chr(184) => 'k', chr(196).chr(185) => 'L',
			chr(196).chr(186) => 'l', chr(196).chr(187) => 'L',
			chr(196).chr(188) => 'l', chr(196).chr(189) => 'L',
			chr(196).chr(190) => 'l', chr(196).chr(191) => 'L',
			chr(197).chr(128) => 'l', chr(197).chr(129) => 'L',
			chr(197).chr(130) => 'l', chr(197).chr(131) => 'N',
			chr(197).chr(132) => 'n', chr(197).chr(133) => 'N',
			chr(197).chr(134) => 'n', chr(197).chr(135) => 'N',
			chr(197).chr(136) => 'n', chr(197).chr(137) => 'N',
			chr(197).chr(138) => 'n', chr(197).chr(139) => 'N',
			chr(197).chr(140) => 'O', chr(197).chr(141) => 'o',
			chr(197).chr(142) => 'O', chr(197).chr(143) => 'o',
			chr(197).chr(144) => 'O', chr(197).chr(145) => 'o',
			chr(197).chr(146) => 'OE',chr(197).chr(147) => 'oe',
			chr(197).chr(148) => 'R',chr(197).chr(149) => 'r',
			chr(197).chr(150) => 'R',chr(197).chr(151) => 'r',
			chr(197).chr(152) => 'R',chr(197).chr(153) => 'r',
			chr(197).chr(154) => 'S',chr(197).chr(155) => 's',
			chr(197).chr(156) => 'S',chr(197).chr(157) => 's',
			chr(197).chr(158) => 'S',chr(197).chr(159) => 's',
			chr(197).chr(160) => 'S', chr(197).chr(161) => 's',
			chr(197).chr(162) => 'T', chr(197).chr(163) => 't',
			chr(197).chr(164) => 'T', chr(197).chr(165) => 't',
			chr(197).chr(166) => 'T', chr(197).chr(167) => 't',
			chr(197).chr(168) => 'U', chr(197).chr(169) => 'u',
			chr(197).chr(170) => 'U', chr(197).chr(171) => 'u',
			chr(197).chr(172) => 'U', chr(197).chr(173) => 'u',
			chr(197).chr(174) => 'U', chr(197).chr(175) => 'u',
			chr(197).chr(176) => 'U', chr(197).chr(177) => 'u',
			chr(197).chr(178) => 'U', chr(197).chr(179) => 'u',
			chr(197).chr(180) => 'W', chr(197).chr(181) => 'w',
			chr(197).chr(182) => 'Y', chr(197).chr(183) => 'y',
			chr(197).chr(184) => 'Y', chr(197).chr(185) => 'Z',
			chr(197).chr(186) => 'z', chr(197).chr(187) => 'Z',
			chr(197).chr(188) => 'z', chr(197).chr(189) => 'Z',
			chr(197).chr(190) => 'z', chr(197).chr(191) => 's',
			// Euro Sign
			chr(226).chr(130).chr(172) => 'E',
			// GBP (Pound) Sign
			chr(194).chr(163) => '');
	
			$string = strtr($string, $chars);
		} else {
			// Assume ISO-8859-1 if not UTF-8
			$chars['in'] = chr(128).chr(131).chr(138).chr(142).chr(154).chr(158)
				.chr(159).chr(162).chr(165).chr(181).chr(192).chr(193).chr(194)
				.chr(195).chr(196).chr(197).chr(199).chr(200).chr(201).chr(202)
				.chr(203).chr(204).chr(205).chr(206).chr(207).chr(209).chr(210)
				.chr(211).chr(212).chr(213).chr(214).chr(216).chr(217).chr(218)
				.chr(219).chr(220).chr(221).chr(224).chr(225).chr(226).chr(227)
				.chr(228).chr(229).chr(231).chr(232).chr(233).chr(234).chr(235)
				.chr(236).chr(237).chr(238).chr(239).chr(241).chr(242).chr(243)
				.chr(244).chr(245).chr(246).chr(248).chr(249).chr(250).chr(251)
				.chr(252).chr(253).chr(255);
	
			$chars['out'] = "EfSZszYcYuAAAAAACEEEEIIIINOOOOOOUUUUYaaaaaaceeeeiiiinoooooouuuuyy";
	
			$string = strtr($string, $chars['in'], $chars['out']);
			$double_chars['in'] = array(chr(140), chr(156), chr(198), chr(208), chr(222), chr(223), chr(230), chr(240), chr(254));
			$double_chars['out'] = array('OE', 'oe', 'AE', 'DH', 'TH', 'ss', 'ae', 'dh', 'th');
			$string = str_replace($double_chars['in'], $double_chars['out'], $string);
		}
	
		return $string;
	}
	
	protected function sanitize_title_with_dashes($title, $switch)
	{
		$title = strip_tags($title);
		// Preserve escaped octets.
		$title = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '---$1---', $title);
		// Remove percent signs that are not part of an octet.
		$title = str_replace('%', '', $title);
		// Restore octets.
		$title = preg_replace('|---([a-fA-F0-9][a-fA-F0-9])---|', '%$1', $title);
	
		$title = $this->remove_accents($title);
		if ($this->seems_utf8($title)) {
			if (function_exists('mb_strtolower')) {
				$title = mb_strtolower($title, 'UTF-8');
			}
			$title = $this->utf8_uri_encode($title, 200);
		}
	
		$title = strtolower($title);
		$title = preg_replace('/&.+?;/', '', $title); // kill entities
		$title = preg_replace('/[^%a-z0-9 _-]/', '', $title);
		$title = preg_replace('/\s+/', $switch, $title);
		$title = preg_replace('|-+|', $switch, $title);
		$title = trim($title, $switch);
	
		return $title;
	}
	
	protected function seems_utf8($Str) { # by bmorel at ssi dot fr
		$length = strlen($Str);
		for ($i=0; $i < $length; $i++) {
			if (ord($Str[$i]) < 0x80) continue; # 0bbbbbbb
			elseif ((ord($Str[$i]) & 0xE0) == 0xC0) $n=1; # 110bbbbb
			elseif ((ord($Str[$i]) & 0xF0) == 0xE0) $n=2; # 1110bbbb
			elseif ((ord($Str[$i]) & 0xF8) == 0xF0) $n=3; # 11110bbb
			elseif ((ord($Str[$i]) & 0xFC) == 0xF8) $n=4; # 111110bb
			elseif ((ord($Str[$i]) & 0xFE) == 0xFC) $n=5; # 1111110b
			else return false; # Does not match any model
			for ($j=0; $j<$n; $j++) { # n bytes matching 10bbbbbb follow ?
				if ((++$i == $length) || ((ord($Str[$i]) & 0xC0) != 0x80))
				return false;
			}
		}
		return true;
	}
	
	protected function utf8_uri_encode( $utf8_string, $length = 0 ) {
		$unicode = '';
		$values = array();
		$num_octets = 1;
		$unicode_length = 0;
	
		$string_length = strlen( $utf8_string );
		for ($i = 0; $i < $string_length; $i++ ) {
	
			$value = ord( $utf8_string[ $i ] );
	
			if ( $value < 128 ) {
				if ( $length && ( $unicode_length >= $length ) )
					break;
				$unicode .= chr($value);
				$unicode_length++;
			} else {
				if ( count( $values ) == 0 ) $num_octets = ( $value < 224 ) ? 2 : 3;
	
				$values[] = $value;
	
				if ( $length && ( $unicode_length + ($num_octets * 3) ) > $length )
					break;
				if ( count( $values ) == $num_octets ) {
					if ($num_octets == 3) {
						$unicode .= '%' . dechex($values[0]) . '%' . dechex($values[1]) . '%' . dechex($values[2]);
						$unicode_length += 9;
					} else {
						$unicode .= '%' . dechex($values[0]) . '%' . dechex($values[1]);
						$unicode_length += 6;
					}
	
					$values = array();
					$num_octets = 1;
				}
			}
		}
	
		return $unicode;
	}
	
	protected function capitalize($txt)
	{
		$pieces = explode(' ', strtolower($txt));
		for($i=0; $i<count($pieces); $i++)
		{
			if($pieces[$i][0] == "(")
				$pieces[$i] = substr_replace($pieces[$i], strtoupper($pieces[$i][1]), 1, 1);
			else
				$pieces[$i] = substr_replace($pieces[$i], strtoupper($pieces[$i][0]), 0, 1);
		}
		$temp = implode(' ', $pieces);
		$temp = str_ireplace(array(' da ', ' das ', ' de ', ' di ', ' do ', ' dos ', ' e '), array(' da ', ' das ', ' de ', ' di ', ' do ', ' dos ', ' e '), $temp);
		
		return mysql_real_escape_string($temp);
	}

	public function permalink($texto, $key='-')
	{
		return $this->sanitize_title_with_dashes($texto, $key);
	}
	
	
	/**
	 * TIME CLASS
	 **/
	
	//pega o nome do mês,
	//a partir do numero
	public function nomeDoMes($mes) {
		switch($mes) {
			case 1: $mes = "Janeiro"; break;
			case 2: $mes = "Fevereiro"; break;
			case 3: $mes = "Março"; break;
			case 4: $mes = "Abril"; break;
			case 5: $mes = "Maio"; break;
			case 6: $mes = "Junho"; break;
			case 7: $mes = "Julho"; break;
			case 8: $mes = "Agosto"; break;
			case 9: $mes = "Setembro"; break;
			case 10: $mes = "Outubro"; break;
			case 11: $mes = "Novembro"; break;
			case 12: $mes = "Dezembro"; break;
			default: $mes = "Janeiro";
		}
		return $mes;
	}
	
	//transforma data em um
	//datetime, do SQL
	public function converterEmDataSQL( $date, $horario="12h00" ){
		$pieces = explode("/", $date);
		$pieces = array_reverse($pieces);
		$date = implode("-", $pieces) . " " . str_replace("h", ":", $horario) . ":00";
		return $date;
	}
	
	//converte SQL datetime
	//para uma data normal
	public function converterEmData( $date, $qual="date" ){
		$pieces = explode(" ", $date);
		$data = explode("-", $pieces[0]);
		$data = array_reverse($data);
		$marcado = implode("/", $data);
		if(count($pieces) > 1){
			$hora = explode(":", $pieces[1]);
			$horario = $hora[0]."h".$hora[1];
		}
		else {
			$horario = "";
		}
		//
		return $qual == "date" ? $marcado : $horario;
	}
	
	//formado de data,
	//a partir de um datetime SQL
	public function formatarData($data_unformated, $horario=true){
		$data_formated = "";

		$ano = substr($data_unformated, 0, 4);
		$mes_int = substr($data_unformated, 5, 2);
		$dia = substr($data_unformated, 8, 2);
		$hora = substr($data_unformated, 11, 2);
		$minuto = substr($data_unformated, 14, 2);
		$segundo = substr($data_unformated, 17, 2);

		$mes = getMonthName($mes_int);

		if(date("d/m/Y") == "$dia/$mes_int/$ano"){
			$hor = $horario ? $hora."h".$minuto : "";
			$data_formated = "Hoje, &agrave;s $hor";
		}
		else{
			$hor = $horario ? ", &agrave;s ${hora}h${minuto}" : "";
			$data_formated = "${dia} de ${mes} de ${ano}$hor";
		}
		return $data_formated;
	}
}

?>