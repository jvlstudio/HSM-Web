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

<style type="text/css">strong {
	color: #000;
}</style>

<ul id="form" class="form">
	<li><h1>Mídia > Detalhes da Campanha</h1></li>
	
	<!-- -->
	<?php 
	# ...
	$cli = (object) $Ads->client($info->client_id); ?>
	<li>Cliente: <strong><?php echo $cli->name;?></strong></li>
	
	<br/>
	<li>Nome da campanha: <strong><?php echo $info->name;?></strong></li>
	<li><em>slug</em>: <strong><?php echo $info->slug;?></strong></li>
	
	<br/>
	<?php
	# ...
	$da = dateObject($info->date_start);
	$de	= dateObject($info->date_end);
	$dc = dateObject($info->date_register); ?>
	<li>Data de início: <strong><?php echo $da->day."/".$da->month."/".$da->year;?>, às <?php echo $da->hour.":".$da->minute;?></strong></li>
	<li>Data de término: <strong><?php echo $de->day."/".$de->month."/".$de->year;?>, às <?php echo $de->hour.":".$de->minute;?></strong></li>
	<li>Data de criação da campanha: <strong><?php echo $dc->day."/".$dc->month."/".$dc->year;?>, às <?php echo $dc->hour.":".$dc->minute;?></strong></li>
	
	<br/>
	<?php 
	# ...
	$opt = $Ads->optionObject($info->options);
	$option_string = "";
	# gender..
	if($opt->gender == "all"
	|| empty($opt->gender)):
		$option_string = "Sem restrição de sexo";
	else:
		$gender = ($opt->gender == "male" ? "Masculino" : "Feminino");
		$option_string = "Apenas usuários do sexo {$gender}";
	endif;
	# age..
	if (!empty($opt->age_start)
	&& 	!empty($opt->age_end)):
		$option_string .= ", entre {$opt->age_start} e {$opt->age_end} anos.";
	elseif(!empty($opt->age_start)
	&& 	empty($opt->age_end)):
		$option_string .= ", a partir de {$opt->age_start} anos.";
	elseif(empty($opt->age_start)
	&& 	!empty($opt->age_end)):
		$option_string .= ", até {$opt->age_end} anos.";
	else:
		$option_string .= ", sem restrição de idade.";
	endif;
	?>
	<li>Segmentação: <strong><?php echo $option_string;?></strong></li>
	
	<br/>
	<?php 
	# clicks & views ...
	$as = $Ads->forCampaign($target_id);
	$count_views = 0;
	$count_clicks = 0;
	foreach ($as as $a):
		$a = (object) $a;
		$count_views += $a->count_views;
		$count_clicks += $a->count_clicks;
	endforeach;
	 ?>
	<li>Cliques: <strong><?php echo $count_clicks;?></strong></li>
	<li>Visualizações: <strong><?php echo $count_views;?></strong></li>
</ul>

<?php
# ...
get_footer(''); ?>