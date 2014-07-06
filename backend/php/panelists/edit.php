<?php
# ...
$info = (object) $Panelists->forId($target_id);
$sy = 'selected="selected"'; $sn = "";

# ...
get_header(''); ?>

<form method="post" action="<?php permalink("/backend/{$args->dir}/handle");?>" id="form_values"  enctype="multipart/form-data">
<input type="hidden" name="scope" value="<?php echo $args->page;?>" />
<input type="hidden" name="id" value="<?php echo $target_id;?>" />

<ul id="form" class="form">
	<li><h1>Palestrantes > Editar</h1></li>
	<!-- -->
	<li><h1>Info</h1></li>
	<li>
		<label>Evento</label><br/>
		<select name="event_id" required>
			<?php 
			$results = $Events->select(); 
			foreach ($results as $res): $res = (object) $res;
			$s = ($info->event_id == $res->id ? 'selected="selected"' : ""); ?>
			<option <?php echo $s;?> value="<?php echo $res->id;?>"><?php echo $res->name;?></option>
			<?php 
			endforeach; ?>
		</select>
	</li>
	<li>
		<label>Nome *</label><br/>
		<input type="text" name="name" maxlength="50" required value="<?php echo $info->name;?>" />
	</li>
	<li>
		<label>Imagem</label><br/>
		<input type="file" name="picture" />
		<?php 
		if($info->picture): ?>
		<div><img src="<?php echo HOST;?>/uploads/panelists/<?php echo $info->picture;?>" alt="" /></div>
		<?php 
		endif; ?>
	</li>
	<li>
		<label>Descrição</label><br/>
		<textarea name="description"><?php echo $info->description;?></textarea>
	</li>
	<!-- -->
	<li><button>EDITAR</button></li>
</ul>
</form>

<?php
# ...
get_footer(''); ?>