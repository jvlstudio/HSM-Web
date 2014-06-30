<?php
# ...
$results = $Events->select("ORDER BY name ASC");
# ...
get_header(''); ?>

<ul id="form" class="form">
	<li><h1>Agenda</h1></li>
	<?php 
	# ...
	foreach ($results as $res):
	$res = (object) $res; ?>
	<h2><?php echo $res->name;?> (<a href="<?php permalink("/backend/{$args->dir}/add/{$res->id}");?>">adicionar item</a>)</h2>
	<?php 
	# ...
	$data = $Agenda->forEvent($res->id);
	foreach ($data as $obj):
	$obj = (object)$obj; 
	$pan = $Panelists->forId($obj->panelist_id); ?>
	<li id="item_<?php echo $obj->id;?>">- <a href="<?php permalink("/backend/{$args->dir}/edit/{$obj->id}");?>"><?php echo $pan->name;?></a> (<a href="javascript:;" onclick="removeObject('<?php echo $args->dir;?>', '<?php echo $obj->id;?>', 'remove');">excluir</a>)</li>
	<?php 
		endforeach;
	endforeach; ?>
</ul>

<?php
# ...
get_footer(''); ?>