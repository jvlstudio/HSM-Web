<?php 

interface iAds
{
	public function select($param="");
	public function get($param="");
	public function forId($id, $param="");
	public function forKey($value, $key="id");
	public function forType($id);
	public function forCampaign($campaign_id, $param="");
	public function forClient($client_id, $param="");
	public function delete($id);
	public function hitView($id);
	public function hitClick($id);
	public function today($profile=NULL, $type=NULL);
	# ...
	public function types();
	public function typesForCampaign($cam_id);
	public function typeLabels();
	public function sizes();
	public function tables();
	public function tableLabels();
	public function positionsLabels($cat_key);
	public function positionForKey($cat_key, $key);
	public function optionObject($options);
	public function optionString($gender, $age_start, $age_end);
	public function optionProfile($gender, $age);
	# campaigns..
	public function campaigns($param="");
	public function campaign($id, $param="");
	public function campaignsForClient($client_id, $param="");
	public function deleteCampaign($id);
	# clients..
	public function clients($param="");
	public function client($id, $param="");
	public function deleteClient($id);
	# activities..
	public function saveActivity($user_id, $ad_id);
	# meta..
	public function metaValuesForParentId($parent_id);
	public function metaValueForParentIdAndKey($parent_id, $meta_key);
	public function metaValuesForKey($key);
}

class Ads extends Functions implements iAds
{
	# ...
	
	private $ios	 = array("640x1136", "620x90", "620x360", "620x90-620x386", "510x100");
	private $android = array("640x1136", "1050x552", "286x214", "640x100", "600x300");
	
	public function select( $param="" )
	{
		$query	= "SELECT * FROM {$this->tb} {$param}";
		$res	= $this->db->results($query);
		$data	= array();
		$p		= 0;
		#
		foreach($res as $arr):
			$obj 	= (object) $arr;
			$infos	= $this->db->results("SELECT * FROM {$this->tbmeta} WHERE parent_id='{$obj->id}'");
			#
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
	public function get( $param="" )
	{
		$res	= $this->db->result("SELECT * FROM {$this->tb} {$param}");
		$obj	= (object) $res;
		$infos	= $this->db->results("SELECT * FROM {$this->tbmeta} WHERE parent_id='{$obj->id}'");
		#
		$data 	= $res;
		if(!empty($infos)):
			foreach($infos as $info):
				$info = (object) $info;
				$data[$info->meta_key] = $info->meta_value;
			endforeach;
		endif;
		
		return $data;
		
		return $data;
	}
	public function forId( $id, $param="" )
	{
		$res	= $this->get("WHERE id='{$id}'");
		return $res;
	}
	public function forKey( $value, $key="id" )
	{
		$res	= $this->get("WHERE {$key}='{$value}'");
		return $res;
	}
	public function forType( $id )
	{
		$res	= $this->select("WHERE `type`='{$id}'");
		return $res;
	}
	public function forCampaign($campaign_id, $param="")
	{
		$res	= $this->select("WHERE `campaign_id`='{$campaign_id}'");
		return $res;
	}
	public function forClient($client_id, $param="")
	{
		$res	= $this->select("WHERE `client_id`='{$client_id}'");
		return $res;
	}
	public function delete($id)
	{
		$info	= (object) $this->forId($id);
		if($info->image_ios)
			unlink("../uploads/ads/".$info->image_ios);
		if($info->image_android)
			unlink("../uploads/ads/".$info->image_android);
		// ..
		$query	= "DELETE FROM {$this->tb} WHERE id='{$id}'";
		$this->db->query($query);
	}
	
	public function hitView($id)
	{
		$this->hit('count_views', $id);
	}
	public function hitClick($id)
	{
		$this->hit('count_clicks', $id);
	}
	private function hit($key, $id)
	{
		$res	= $this->forId($id);
		$res[$key] += 1;
		$query	= "UPDATE {$this->tb} SET {$key}='{$res[$key]}' WHERE id='{$id}'";
		$this->db->q($query);
	}
	
	public function today($profile=NULL, $type=NULL)
	{
		# expect a "optionProfile" object
		# ... or null
		
		$now	= date("Y-m-d H:i:s");
		$edition = "date_start <= '{$now}' AND date_end >= '{$now}'";
		
		$query1	= "SELECT * FROM {$this->tb_cam} WHERE {$edition}";
		$cams	= $this->db->results($query1);
		$cams_to_show = array();
		
		foreach ($cams as $cam)
		{
			$cam = (object) $cam;
			
			# check if we have a profile...
			if ($profile
			&&	!empty($profile->age)
			&&	!empty($profile->gender))
			{
				$cam_option = $this->optionObject($cam->options);
				# gender..
				if ($cam_option->gender == "all"
				||	$cam_option->gender == $profile->gender
				||	empty($cam_option->gender))
					# age (start)..
					if (empty($cam_option->age_start)
					||	$profile->age >= $cam_option->age_start )
						# age (end)..
						if (empty($cam_option->age_end)
						||	$profile->age <= $cam_option->age_end )
						$cams_to_show[] = $cam;
			}
			# if we dont..
			else
			{
				$cams_to_show[] = $cam;
			}
		}
		
		# already get campaigns..
		# so let's work the ads..
		$ads_to_show = array();
		foreach ($cams_to_show as $cam_single)
		{
			$ads = $this->forCampaign($cam_single->id);
			foreach ($ads as $ad)
			{
				if ($type)
				{
					if ($type == $ad['type'])
						$ads_to_show[] = (object) $ad;
				}
				else {
					// annotation is too heavy
					if($ad['type'] != "annotation_feat")
						$ads_to_show[] = (object) $ad;
				}
			}
		}
		
		return $ads_to_show;
	}
	
	# ...
	
	public function types()
	{
		$a = array("superstitial", "banner_footer", "banner_home", "banner_expand", "banner_menu");
		return $a;
	}
	public function typesForCampaign($cam_id)
	{
		$a = $this->types();
		$l = $this->typeLabels();
		$o = array();
		$oc= array();
		
		for($i=0; $i<count($a); $i++):
			$s = new stdClass;
			$s->key = $a[$i];
			$s->label = $l[$i];
			$o[] = $s;
			$oc[]= $s; # copy
		endfor;
		
		$res	= $this->forCampaign($cam_id);
		foreach ($res as $info):
			$info = (object) $info;
			for($r=0; $r<count($o); $r++):
				$type = $o[$r];
				if ($info->type == $type->key
				&&	$info->type != "annotation_feat")
					unset($oc[$r]);
			endfor;
		endforeach;
			
		return $oc;
	}
	public function typeLabels()
	{
		$a = array("Splash Inicial", "Banner Rodapé", "Banner Principal (Home)", "Banner Expansível (Home)", "Banner Menu Lateral");
		return $a;
	}
	public function labelForType($type)
	{
		$a = $this->typeLabels();
		$d = $this->types();
		$c = "";
		
		$e = 0;
		foreach ($d as $b):
			if($b == $type)
				$c = $a[$e];
			$e++;
		endforeach;
				
		return $c;
	}
	public function sizes()
	{
		$types 		= $this->types();
		
		$pointer 	= 0;
		$returnArr	= array();
						
		foreach ($types as $type)
		{
			$obj		= new stdClass;
			$dimen_ios	= new stdClass;
			$dimen_and	= new stdClass;
			$dimen_ios_exp	= new stdClass;
			$dimen_and_exp	= new stdClass;
			
			$v_ios		= $this->ios;
			$v_and		= $this->android;
			
			if ($type == "banner_expand") {
				$xx_ios	= explode("-", $v_ios[$pointer]);
				$xx_and	= explode("-", $v_and[$pointer]);
				$x_ios	= explode("x", $xx_ios[0]);
				$x_and	= explode("x", $xx_and[0]);
				$xe_ios	= explode("x", $xx_ios[1]);
				$xe_and	= explode("x", $xx_and[1]);
				
				$dimen_ios_exp->width	= $xe_ios[0];
				$dimen_ios_exp->height	= $xe_ios[1];
				
				$dimen_and_exp->width	= $xe_and[0];
				$dimen_and_exp->height	= $xe_and[1];
				
				$obj->ios_exp	= $dimen_ios_exp;
				$obj->android_exp = $dimen_and_exp;
			}
			else {
				$x_ios	= explode("x", $v_ios[$pointer]);
				$x_and	= explode("x", $v_and[$pointer]);
			}
			
			$dimen_ios->width	= $x_ios[0];
			$dimen_ios->height	= $x_ios[1];
			
			$dimen_and->width	= $x_and[0];
			$dimen_and->height	= $x_and[1];
			
			$obj->ios	= $dimen_ios;
			$obj->android = $dimen_and;
			
			$returnArr[$type] = $obj;
			$pointer++;
		}
		
		return $returnArr;
	}
	public function tables()
	{
		$a = array("none", "events", "venues", "categories");
		return $a;
	}
	public function tableLabels()
	{
		$a = array("Nenhum", "Eventos", "Espaços Culturais", "Categorias");
		return $a;
	}
	public function positionsLabels($cat_key)
	{
		$a = array();
		
		switch ($cat_key)
		{
			case "carousel_feat":
				$a = array("Primeiro", "Segundo");
				break;
			case "carousel_category":
				$a = array("Primeiro (Primeira Linha)", "Segundo (Primeira Linha)", "Primeiro (Segunda Linha)", "Segundo (Segunda Linha)");
				break;
			case "menu":
				$a = array("Final");
				break;
			case "event_break":
				$a = array("Início", "Meio/Randômico");
				break;
			default:
				$a = array();
				break;
		}
		
		/*
		# get only those positions who hasn't ads yet
		$query	= "SELECT * FROM {$this->tb} WHERE campaign_id='{$cam_id}'";
		$res	= $this->db->results($query);
		
		foreach ($res as $info):
			$info = (object) $info;
			for($i=0; $i<count($a); $i++)
				if ($info->position == $i)
					unset($a[$i]);
		endforeach;*/
		
		return $a;
	}
	public function positionForKey($cat_key, $key)
	{
		$a = "";
		
		switch ($cat_key)
		{
			# ...
			case "carousel_feat":
				switch ($key)
				{
					case 0:
						$a = "Primeiro";
						break;
					case 1:
						$a = "Segundo";
						break;
				}
				break;
			# ...
			case "carousel_category":
				switch ($key)
				{
					case 0:
						$a = "Primeiro (Primeira Linha)";
						break;
					case 1:
						$a = "Segundo (Primeira Linha)";
						break;
					case 2:
						$a = "Primeiro (Segunda Linha)";
						break;
					case 3:
						$a = "Segundo (Segunda Linha)";
						break;
				}
				break;
			# ...
			case "menu":
				$a = "Final";
				break;
			# ..
			case "event_break":
				switch ($key)
				{
					case 0:
						$a = "Início";
						break;
					case 1:
						$a = "Meio/Randômico";
						break;
				}
				break;
			# ...
			default:
				$a = "";
				break;
		}
		
		return $a;
	}
	
	public function optionObject($options)
	{
		# expect a string like this: gender:male|age:18-30
		$values		= explode("|", $options);	// separate gender from age
		$gender_val	= explode(":", $values[0]);	// gender
		$age_val	= explode(":", $values[1]); // age
		$age_vals	= explode("-", $age_val[1]);// start and end
		
		$obj			= new stdClass;
		$obj->gender	= $gender_val[1];
		$obj->age_start	= $age_vals[0];
		$obj->age_end	= $age_vals[1];
		
		return $obj;
	}
	public function optionString($gender, $age_start, $age_end)
	{
		$opt_gender = ($gender ? "gender:".$gender : "");
		$opt_age	= (($age_start || $age_end) ? "age:".$age_start."-".$age_end : "");
		$options	= $opt_gender."|".$opt_age;
		
		return $options;
	}
	public function optionProfile($gender, $age)
	{
		$opt = new stdClass;
		$opt->gender = $gender;
		$opt->age	 = $age;
		
		return $opt;
	}
	
	# campaigns
	# ...
	
	public function campaigns($param="")
	{
		$query 	= "SELECT * FROM {$this->tb_cam} {$param}";
		$res	= $this->db->results($query);
		return $res;
	}
	public function campaign($id, $param="")
	{
		$query 	= "SELECT * FROM {$this->tb_cam} WHERE id='{$id}' {$param}";
		$res	= $this->db->result($query);
		return $res;
	}
	public function campaignsForClient($client_id, $param="")
	{
		$res	= $this->campaigns("WHERE client_id='{$client_id}' {$param}");
		return $res;
	}
	public function deleteCampaign($id)
	{
		// campaign..
		$query1	= "DELETE FROM {$this->tb_cam} WHERE id='{$id}'";
		$this->db->query($query1);
		// ads..
		$res	= $this->forCampaign($id);
		foreach ($res as $cam):
			$cam = (object) $cam;
			$this->delete($cam->id);
		endforeach;
	}
	
	# clients
	# ...
	
	public function clients($param="")
	{
		$query 	= "SELECT * FROM {$this->tb_cli} {$param}";
		$res	= $this->db->results($query);
		return $res;
	}
	public function client($id, $param="")
	{
		$query 	= "SELECT * FROM {$this->tb_cli} WHERE id='{$id}' {$param}";
		$res	= $this->db->result($query);
		return $res;
	}
	public function deleteClient($id)
	{
		// campaign..
		$query1	= "DELETE FROM {$this->tb_cli} WHERE id='{$id}'";
		$this->db->query($query1);
		// ads..
		$res	= $this->campaignsForClient($id);
		foreach ($res as $cam):
			$cam = (object) $cam;
			$this->deleteCampaign($cam->id);
		endforeach;
	}
	
	# activities
	# ...
	
	public function saveActivity($user_id, $ad_id, $latlng="")
	{
		$now	= date("Y-m-d H:i:s");
		$query	= "INSERT INTO {$this->tb_act}(user_id, ad_id, latlng, date_register) VALUES('{$user_id}', '{$ad_id}', '{$latlng}', '{$now}')";
		$this->db->q($query);
	}
	
	# meta
	# ...
	
	public function metaValuesForParentId( $parent_id )
	{
		$query = "SELECT * FROM {$this->tbmeta} WHERE parent_id='{$parent_id}'";
		$res	= $this->db->results($query);
		return $res;
	}
	public function metaValueForParentIdAndKey( $parent_id, $meta_key )
	{
		$query = "SELECT * FROM {$this->tbmeta} WHERE parent_id='{$parent_id}' AND meta_key='{$meta_key}'";
		$res	= $this->db->result($query);
		return $res;
	}
	public function metaValuesForKey($key)
	{
		$query = "SELECT * FROM {$this->tbmeta} WHERE meta_key='{$key}'";
		$res	= $this->db->results($query);
		return $res;
	}
}

?>