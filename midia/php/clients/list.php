<?php
# ...
$results = $Ads->clients("ORDER BY name ASC");
# ...
get_header(''); ?>

<ul class="form">
	<li><a href="<?php permalink("/midia/{$args->dir}/add");?>">[+] Adicionar novo cliente</a></li>
</ul>

<ul id="form" class="form">
	<h1 class="pb10">Clientes</h1>
	<?php 
	foreach ($results as $res): $res = (object) $res; ?>
	<li id="item_<?php echo $res->id;?>">- <a href="<?php permalink("/midia/{$args->dir}/edit/{$res->id}");?>"><?php echo $res->name;?></a> (<a href="javascript:;" onclick="removeObject('<?php echo $args->dir;?>', '<?php echo $res->id;?>', 'remove', 'midia');">excluir</a>)</li>
	<?php endforeach; ?>
</ul>

<?php
# ...
get_footer(''); ?>