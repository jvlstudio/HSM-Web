<?php
# ...
$info = (object) $Ads->client($target_id);
$sy = 'selected="selected"'; $sn = "";
# ...
get_header(''); ?>

<form method="post" action="<?php permalink("/midia/{$args->dir}/handle");?>" id="form_values" >
<input type="hidden" name="scope" value="<?php echo $args->page;?>" />
<input type="hidden" name="id" value="<?php echo $target_id;?>" />

<ul id="form" class="form">
	<li><h1>Clientes > Editar</h1></li>
	
	<li>
		<label>Nome *</label><br/>
		<input type="text" name="name" value="<?php echo $info->name;?>" required />
	</li>
	<li>
		<label><em>Slug</em> *</label><br/>
		<input type="text" name="slug" value="<?php echo $info->slug;?>" required />
	</li>
	
	<!-- -->
	<li><button>EDITAR</button></li>
</ul>
</form>

<?php
# ...
get_footer(''); ?>