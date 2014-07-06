<?php
# ...
$info = (object) $Magazines->forId($target_id);
$sy = 'selected="selected"'; $sn = "";

# ...
get_header(''); ?>

<form method="post" action="<?php permalink("/backend/{$args->dir}/handle");?>" id="form_values" enctype="multipart/form-data">
<input type="hidden" name="scope" value="<?php echo $args->page;?>" />
<input type="hidden" name="id" value="<?php echo $target_id;?>" />

<ul id="form" class="form">
	<li><h1>Revistas > Adicionar</h1></li>
	<!-- -->
	<li><h1>Info</h1></li>
	<li>
		<label>Nome (Edição) *</label><br/>
		<input type="text" name="name" maxlength="50" required value="<?php echo $info->name;?>" />
	</li>
	<li>
		<label>Descrição (Ano de publicação) *</label><br/>
		<textarea name="description" required><?php echo $info->description;?></textarea>
	</li>
	<li>
		<label>Imagem</label><br/>
		<input type="file" name="picture" />
		<?php 
		if($info->picture): ?>
		<div><img src="<?php echo HOST;?>/uploads/magazines/<?php echo $info->picture;?>" alt="" /></div>
		<?php 
		endif; ?>
	</li>
	<li>
		<label>Link para compra</label><br/>
		<input type="text" name="link" maxlength="200" value="<?php echo $info->link;?>" />
	</li>
	<!-- -->
	<li><button>EDITAR</button></li>
</ul>
</form>

<?php
# ...
get_footer(''); ?>