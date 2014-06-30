<?php
# ...
$results = $Events->select("ORDER BY name ASC");
# ...
get_header(''); ?>

<ul class="form">
	<li><a href="<?php permalink("/backend/{$args->dir}/add");?>">[+] Adicionar novo passe</a></li>
</ul>

<ul id="form" class="form">
	<li><h1>Passes</h1></li>
	<?php 
	# ...
	foreach ($results as $res): $res = (object) $res;?>
	<li><h3><?php echo $res->name;?></h3></li>
	<?php 
	# ...
	$objs = $Passes->forEventId($res->id);
	foreach ($objs as $obj): $obj = (object) $obj; ?>
	<li id="item_<?php echo $obj->id;?>">- <a href="<?php permalink("/backend/{$args->dir}/edit/{$obj->id}");?>"><?php echo $obj->name;?> (<?php echo $Passes->labelForColor($obj->color);?>)</a> (<a href="javascript:;" onclick="removeObject('<?php echo $args->dir;?>', '<?php echo $obj->id;?>', 'remove');">excluir</a>)</li>
	<?php 
		endforeach;
	endforeach; ?>
</ul>

<?php
# ...
get_footer(''); ?>