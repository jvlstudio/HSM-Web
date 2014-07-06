<?php
# ...
$results = $Magazines->select();
# ...
get_header(''); ?>

<ul class="form">
	<li><a href="<?php permalink("/backend/{$args->dir}/add");?>">[+] Adicionar nova revista</a></li>
</ul>

<ul id="form" class="form">
	<li><h1>Revistas</h1></li>
	<?php 
	# ...
	foreach ($results as $res):
	$obj = (object) $res; ?>
	<li id="item_<?php echo $obj->id;?>">- <a href="<?php permalink("/backend/{$args->dir}/edit/{$obj->id}");?>"><?php echo $obj->name;?></a> (<a href="javascript:;" onclick="removeObject('<?php echo $args->dir;?>', '<?php echo $obj->id;?>', 'remove');">excluir</a>)</li>
	<?php 
	endforeach; ?>
</ul>

<?php
# ...
get_footer(''); ?>