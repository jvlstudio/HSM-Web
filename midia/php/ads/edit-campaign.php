<?php
# ...
$info = (object) $Ads->campaign($target_id);
$sy = 'selected="selected"'; $sn = "";
$cy	= 'checked="checked"'; $cn = "";
# ...
# d start..
$da		= explode(" ", $info->date_start);
$dsx	= explode("-", $da[0]);
$dsi	= array_reverse($dsx);
$dstart	= implode("/", $dsi);
$hstart	= $da[1];
# d end..
$de		= explode(" ", $info->date_end);
$dex	= explode("-", $de[0]);
$dei	= array_reverse($dex);
$dend	= implode("/", $dei);
$hend	= $de[1];
# ...
get_header(''); ?>

<form method="post" action="<?php permalink("/midia/{$args->dir}/handle");?>" id="form_values">
<input type="hidden" name="scope" value="<?php echo $args->page;?>" />
<input type="hidden" name="id" value="<?php echo $target_id;?>" />

<ul id="form" class="form">
	<li><h1>Mídia > Editar Campanha</h1></li>
	
	<!-- -->
	<li>
		<label>Cliente</label><br/>
		<select name="client_id">
			<option value="0">Nenhum</option>
			<?php 
			$results = $Ads->clients(); 
			foreach ($results as $res): $res = (object) $res; 
			$s = ($res->id == $info->client_id ? $sy : $sn); ?>
			<option <?php echo $s;?> value="<?php echo $res->id;?>"><?php echo $res->name;?></option>
			<?php 
			endforeach; ?>
		</select>
	</li>
	
	<!-- -->
	<li><h1>Informações</h1></li>
	<li>
		<label>Nome *</label><br/>
		<input type="text" name="name" value="<?php echo $info->name;?>" required id="ipt_name" />
		<div>Máximo: <span id="ipt_name_counter"></span></div>
	</li>
	<li>
		<label><em>Slug</em> *</label><br/>
		<input type="text" name="slug" value="<?php echo $info->slug;?>" required />
	</li>
	
	<!-- -->
	<li><h1>Datas</h1></li>
	<li>
		<label>Data de início *</label><br/>
		<input type="text" name="date_start" id="ipt_date_start" required value="<?php echo $dstart;?>" />
	</li>
	<li>
		<label>Data de término *</label><br/>
		<input type="text" name="date_end" id="ipt_date_end" required value="<?php echo $dend;?>" />
	</li>
	
	<!-- -->
	<li><h1>Horários</h1></li>
	<li>
		<label>Horário de início (referente a data de início)*</label><br/>
		<input type="text" name="hour_start" class="hour" required value="<?php echo $hstart;?>" />
	</li>
	<li>
		<label>Data de término (referente a data de término)*</label><br/>
		<input type="text" name="hour_end" class="hour" required value="<?php echo $hend;?>" />
	</li>
	
	<!-- 
	<li><h1>Segmentações</h1></li>
	<?php 
	// options..
	$opt = $Ads->optionObject($info->options);
	// gender
	$gender_male = $gender_female = $gender_all = $cn;
	switch ($opt->gender):
		case 'male': $gender_male = $cy; break;
		case 'female': $gender_female = $cy; break;
		case 'all': $gender_all = $cy; break;
	endswitch;
	// age
	$age_start 	= $opt->age_start;
	$age_end	= $opt->age_end;  ?>
	<li>
		<label>Sexo</label>
		<input type="radio" name="opt[gender]" id="gender_male" value="male" <?php echo $gender_male;?> />
		<label for="gender_male">Masculino</label>
		<input type="radio" name="opt[gender]" id="gender_female" value="female" <?php echo $gender_female;?> />
		<label for="gender_female">Feminino</label>
		<input type="radio" name="opt[gender]" id="gender_all" value="all" <?php echo $gender_all;?> />
		<label for="gender_all">Ambos</label>
	</li>
	<li>
		<label>Idade (deixe vazio para contemplar todas as idades)</label><br/>
		<label>de</label>
		<input type="text" name="opt[age_start]" style="width: 50px;" maxlength="2" value="<?php echo $age_start;?>" />
		<label>a</label>
		<input type="text" name="opt[age_end]" style="width: 50px;" maxlength="2" value="<?php echo $age_end;?>" />
	</li>
	
	 -->
	<li><button>EDITAR</button></li>
</ul>
</form>

<?php
# ...
get_footer(''); ?>