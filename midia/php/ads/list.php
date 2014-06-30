<?php
# ...
$results = $Ads->clients();
# ...
get_header(''); ?>

<ul class="form">
	<li><a href="<?php permalink("/midia/{$args->dir}/add-campaign");?>">[+] Adicionar nova campanha</a></li>
	<li><a href="<?php permalink("/midia/{$args->dir}/schedule-campaigns");?>">[+] Calendário de campanhas</a></li>
</ul>

<ul id="form" class="form">
	<h1 class="pb10">Campanhas</h1>
	<?php // clients
	foreach ($results as $cli): $cli = (object) $cli; ?>
	<h1><?php echo $cli->name;?></h1>
		<?php 
		$cats = $Ads->campaignsForClient($cli->id);
		foreach ($cats as $cat): $cat = (object) $cat; ?>
		<div class="not-toggle" style="padding-left: 30px;">
			<li class="pt10"><h2><?php echo $cat->name;?> (<a href="<?php permalink("/midia/{$args->dir}/detail/{$cat->id}");?>">detalhes</a> | <a href="<?php permalink("/midia/{$args->dir}/add/{$cat->id}");?>">adicionar mídia</a> | <a href="<?php permalink("/midia/{$args->dir}/edit-campaign/{$cat->id}");?>">editar</a> | <a href="javascript:;" onclick="removeObject('<?php echo $args->dir;?>', '<?php echo $cat->id;?>', 'remove-campaign', 'midia');">excluir</a>)</h2></li>
			<div class="container" style="padding-left: 30px;">
				<?php 
				$items = $Ads->forCampaign($cat->id);
				foreach ($items as $res): $res = (object) $res; ?>
				<li id="item_<?php echo $res->id;?>">- <a href="<?php permalink("/midia/{$args->dir}/edit/{$res->id}");?>"><?php echo $Ads->labelForType($res->type);?>  [<?php echo $Ads->positionForKey($res->type, $res->position);?>]</a> (<a href="javascript:;" onclick="removeObject('<?php echo $args->dir;?>', '<?php echo $res->id;?>', 'remove', 'midia');">excluir</a>)</li>
				<?php endforeach; ?>
			</div>
		</div>
		<?php endforeach;?>
	<?php endforeach;?>
	
	<?php // uncategory ?>
	<h1>Sem cliente</h1>
	<?php 
	$cats = $Ads->campaignsForClient(0);
	foreach ($cats as $cat): $cat = (object) $cat; ?>
	<div class="not-toggle" style="padding-left: 30px;">
		<li class="pt10"><h2><?php echo $cat->name;?> (<a href="<?php permalink("/midia/{$args->dir}/detail/{$cat->id}");?>">detalhes</a> | <a href="<?php permalink("/midia/{$args->dir}/add/{$cat->id}");?>">adicionar mídia</a> | <a href="<?php permalink("/midia/{$args->dir}/edit-campaign/{$cat->id}");?>">editar</a> | <a href="javascript:;" onclick="removeObject('<?php echo $args->dir;?>', '<?php echo $cat->id;?>', 'remove-campaign', 'midia');">excluir</a>)</h2></li>
		<div class="container" style="padding-left: 30px;">
			<?php 
			$items = $Ads->forCampaign($cat->id);
			foreach ($items as $res): $res = (object) $res; ?>
			<li id="item_<?php echo $res->id;?>">- <a href="<?php permalink("/midia/{$args->dir}/edit/{$res->id}");?>"><?php echo $Ads->labelForType($res->type);?> [<?php echo $Ads->positionForKey($res->type, $res->position);?>]</a> (<a href="javascript:;" onclick="removeObject('<?php echo $args->dir;?>', '<?php echo $res->id;?>', 'remove', 'midia');">excluir</a>)</li>
			<?php endforeach; ?>
		</div>
	</div>
	<?php endforeach;?>
</ul>

<?php
# ...
get_footer(''); ?>