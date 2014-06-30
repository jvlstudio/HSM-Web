<?php
# ...
$sy = 'selected="selected"'; $sn = "";
$sizes = $Ads->sizes();
$cam  = (object) $Ads->campaign($target_id);
$campaign_name = $cam->name;
get_header(''); ?>

<style>.expanded {
	opacity: 0.5;
}</style>

<form method="post" action="<?php permalink("/midia/{$args->dir}/handle");?>" id="form_values" enctype="multipart/form-data">
<input type="hidden" name="scope" value="<?php echo $args->page;?>" />
<input type="hidden" name="campaign_id" value="<?php echo $target_id;?>" />
<ul id="form" class="form">
	<li><h1>Mídia > Adicionar</h1></li>
	
	<!-- -->
	<li><label>Campanha: <?php echo $campaign_name;?></label></li>
	<li>
		<label>Tipo</label><br/>
		<select name="type" id="select_type" required>
			<option value="">Selecione...</option>
			<?php 
			$r = 0;
			$results = $Ads->typesForCampaign($target_id); 
			foreach ($results as $res): ?>
			<option value="<?php echo $res->key;?>"><?php echo $res->label;?> (iOS: <?php echo $sizes[$res->key]->ios->width;?>x<?php echo $sizes[$res->key]->ios->height;?>, Android: <?php echo $sizes[$res->key]->android->width;?>x<?php echo $sizes[$res->key]->android->height;?>)</option>
			<?php 
			$r++; endforeach; ?>
		</select>
	</li><!--
	<li>
		<label>Campanha</label><br/>
		<select name="campaign_id" id="select_campaign">
			<?php 
			$results = $Ads->campaigns(); 
			foreach ($results as $res): $res = (object) $res;
			$s = ($res->id == $target_id ? $sy : $sn); ?>
			<option <?php echo $s;?> value="<?php echo $res->id;?>"><?php echo $res->name;?></option>
			<?php 
			endforeach; ?>
		</select>
	</li>-->
	
	<li>
		<label>Link *:</label><br/>
		<input type="text" name="link" required value="" />
	</li>
	<li id="li_position" style="display: none;">
		<label>Posição:</label><br/>
		<select name="position" id="select_position">
			<?php 
			$results = $Ads->positionsLabels(); 
			$r = 0;
			foreach ($results as $res): ?>
			<option value="<?php echo $r;?>"><?php echo $res;?></option>
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
		<input type="text" name="latlng" id="ipt_latlng" />
	</li>
	</div>
	
	<!-- -->
	<li><h1>Imagens</h1></li>
	<li>
		<label>Imagem (iOS):</label><br/>
		<input type="file" name="image_ios" />
	</li>
	<li>
		<label>Imagem Expansível (iOS):</label><br/>
		<input type="file" name="image_ios_exp" class="expanded" disabled="disabled" />
	</li>
	<li>
		<label>Imagem (Android):</label><br/>
		<input type="file" name="image_android" />
	</li>
	<li>
		<label>Imagem Expansível (Android):</label><br/>
		<input type="file" name="image_android_exp" class="expanded" disabled="disabled" />
	</li>
	
	<!-- -->
	<li><button>ADICIONAR</button></li>
</ul>
</form>

<?php
# ...
get_footer(''); ?>