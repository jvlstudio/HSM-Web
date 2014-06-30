<?php
# ...
$info = (object) $Events->forId($target_id);
$sy = 'selected="selected"'; $sn = "";

# ...
get_header(''); ?>

<form method="post" action="<?php permalink("/backend/{$args->dir}/handle");?>" id="form_values" enctype="multipart/form-data">
<input type="hidden" name="scope" value="<?php echo $args->page;?>" />
<input type="hidden" name="id" value="<?php echo $target_id;?>" />

<ul id="form" class="form">
	<li><h1>Eventos > Editar</h1></li>
	<!-- -->
	<li><h1>Info</h1></li>
	<li>
		<label>Nome do Evento *</label><br/>
		<input type="text" name="name" maxlength="50" required value="<?php echo $info->name;?>" />
	</li>
	<li>
		<label>Slug</label><br/>
		<input type="text" name="slug" maxlength="50" value="<?php echo $info->slug;?>" />
	</li>
	<li>
		<label>Descrição</label><br/>
		<textarea name="description"><?php echo $info->description;?></textarea>
	</li>
	<li>
		<label>Resumo (Pequena Descrição)</label><br/>
		<input type="text" name="tiny_description" maxlength="200" value="<?php echo $info->tiny_description;?>" />
	</li>
	<li>
		<label>Datas</label><br/>
		<div id="dates_wrap">
			<?php 
			$p = 0;
			$dates = explode("|", $info->info_dates);
			foreach ($dates as $datestr): ?>
			<div><input type="text" name="info_dates[]" class="date_pick" value="<?php echo $datestr;?>" /> <?php if($p>0):?> <i class="fa fa-times removedate datehandle"></i><?php endif;?></div>
			<?php 
			$p++;
			endforeach; ?>
		</div>
		<div class="button adddate" style="width: 100px;"><i class="fa fa-plus"></i> Adicionar data</div>
	</li>
	<li>
		<label>Horário</label><br/>
		<input type="text" name="info_hours" maxlength="50" value="<?php echo $info->info_hours;?>" />
	</li>
	<li>
		<label>Local</label><br/>
		<input type="text" name="info_locale" maxlength="50" value="<?php echo $info->info_locale;?>" />
	</li>
	<li><h1>Imagens</h1></li>
	<li>
		<label>Imagem para Lista</label><br/>
		<input type="file" name="image_list" />
		<?php 
		if($info->image_list): ?>
		<div><img src="<?php echo HOST;?>/uploads/events/<?php echo $info->image_list;?>" alt="" /></div>
		<?php 
		endif; ?>
	</li>
	<li>
		<label>Imagem para Single</label><br/>
		<input type="file" name="image_single" />
		<?php 
		if($info->image_list): ?>
		<div><img src="<?php echo HOST;?>/uploads/events/<?php echo $info->image_single;?>" alt="" /></div>
		<?php 
		endif; ?>
	</li>
	<!-- -->
	<li><button>EDITAR</button></li>
</ul>
</form>

<?php
# ...
get_footer(''); ?>