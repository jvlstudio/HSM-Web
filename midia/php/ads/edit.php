<?php
# ...
$info = (object) $Ads->forId($target_id);
$sy = 'selected="selected"'; $sn = "";
$sizes = $Ads->sizes();
$cam  = (object) $Ads->campaign($info->campaign_id);
$campaign_name = $cam->name;
# ...
get_header(''); ?>

<script type="text/javascript">
$(function(){
	loadPositions(<?php echo $info->position;?>);
});
</script>

<form method="post" action="<?php permalink("/midia/{$args->dir}/handle");?>" id="form_values" enctype="multipart/form-data">
<input type="hidden" name="scope" value="<?php echo $args->page;?>" />
<input type="hidden" name="id" value="<?php echo $target_id;?>" />

<ul id="form" class="form">
	<li><h1>Mídia > Editar</h1></li>
	
	<!-- -->
	<li><label>Campanha: <?php echo $campaign_name;?></label></li>
	<li>
		<?php 
		$r = 0;
		$results = $Ads->types(); 
		$labels	 = $Ads->typeLabels();
		
		$str = "";
		foreach ($results as $res):
			if($info->type == $res):
				$str = "{$labels[$r]} iOS: {$sizes[$res]->ios->width}x{$sizes[$res]->ios->height}, Android: {$sizes[$res]->android->width}x{$sizes[$res]->android->height}";
			endif;
			$r++;
		endforeach;
		?>
		<label>Tipo: <strong><?php echo $str;?></strong></label><br/>
		<input type="hidden" name="" id="select_type" value="<?php echo $info->type;?>" />
	</li><!--
	<li>
		<label>Campanha</label><br/>
		<select name="campaign_id">
			<?php 
			$results = $Ads->campaigns(); 
			foreach ($results as $res): $res = (object) $res; 
			$s = ($res->id == $info->campaign_id ? $sy : $sn); ?>
			<option <?php echo $s;?> value="<?php echo $res->id;?>"><?php echo $res->name;?></option>
			<?php 
			endforeach; ?>
		</select>
	</li>-->
	
	<li>
		<label>Link *:</label><br/>
		<input type="text" name="link" required value="<?php echo $info->link;?>" />
	</li>
	<li id="li_position">
		<label>Posição:</label><br/>
		<select name="position" id="select_position">
			<?php 
			$results = $Ads->positionsLabels(); 
			$r = 0;
			foreach ($results as $res):
			$s = ($r == $info->position ? $sy : $sn); ?>
			<option <?php echo $s;?> value="<?php echo $r;?>"><?php echo $res;?></option>
			<?php 
			$r++; endforeach; ?>
		</select>
	</li>
	
	<div id="li_map" style="display: none;">
	<li>
		<label><strong>Buscar</strong>
		<br/><input type="text" name="address" id="address" /> <button onclick="codeAddress(); return false;">Buscar</button>
	</li>
	<li><div id="google_map"></div></li>
	<li>
		<label>Latitude/Longitude</label><br/>
		<input type="text" name="latlng" id="ipt_latlng" value="<?php echo $info->latlng;?>" />
	</li>
	</div>
	
	<!-- -->
	<li><h1>Imagens</h1></li>
	<li>
		<label>Imagem (iOS):</label><br/>
		<input type="file" name="image_ios" /><br/>
		<?php 
		if($info->image_ios): ?>
		<br/>
		<label>Visualização :</label><br/>
		<img src="<?php echo HOST;?>/uploads/ads/<?php echo $info->image_ios;?>" width="<?php echo $sizes[$info->type]->ios->width/2;?>" height="<?php echo $sizes[$info->type]->ios->height/2;?>" alt="" />
		<?php 
		endif; ?>
	</li>
	<?php 
	if($info->type == "banner_expand"): ?>
	<li>
		<label>Imagem Expansível (iOS):</label><br/>
		<input type="file" name="image_ios_exp" /><br/>
		<?php 
		if($info->image_ios_exp): ?>
		<br/>
		<label>Visualização :</label><br/>
		<img src="<?php echo HOST;?>/uploads/ads/<?php echo $info->image_ios_exp;?>" width="<?php echo $sizes[$info->type]->ios_exp->width/2;?>" height="<?php echo $sizes[$info->type]->ios_exp->height/2;?>" alt="" />
		<?php 
		endif; ?>
	</li>
	<?php endif; ?>
	<li>
		<label>Imagem (Android):</label><br/>
		<input type="file" name="image_android" /><br/>
		<?php 
		if($info->image_android): ?>
		<br/>
		<label>Visualização :</label><br/>
		<img src="<?php echo HOST;?>/uploads/ads/<?php echo $info->image_android;?>" width="<?php echo $sizes[$info->type]->android->width/2;?>" height="<?php echo $sizes[$info->type]->android->height/2;?>" alt="" />
		<?php 
		endif; ?>
	</li>
	<?php 
	if($info->type == "banner_expand"): ?>
	<li>
		<label>Imagem Expansível (Android):</label><br/>
		<input type="file" name="image_android_exp" /><br/>
		<?php 
		if($info->image_android_exp): ?>
		<br/>
		<label>Visualização :</label><br/>
		<img src="<?php echo HOST;?>/uploads/ads/<?php echo $info->image_android_exp;?>" width="<?php echo $sizes[$info->type]->android_exp->width/2;?>" height="<?php echo $sizes[$info->type]->android_exp->height/2;?>" alt="" />
		<?php 
		endif; ?>
	</li>
	<?php endif; ?>
	
	<li>Criado em: <?php echo $info->date_register;?></li>
	
	<!-- -->
	<li><button>EDITAR</button></li>
</ul>
</form>

<?php
# ...
get_footer(''); ?>