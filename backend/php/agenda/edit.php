<?php
# ...
$info = (object) $Agenda->forId($target_id);
$event = $Events->forId($info->event_id);
$sy = 'selected="selected"'; $sn = "";

# ...
get_header(''); ?>

<form method="post" action="<?php permalink("/backend/{$args->dir}/handle");?>" id="form_values">
<input type="hidden" name="scope" value="<?php echo $args->page;?>" />
<input type="hidden" name="id" value="<?php echo $target_id;?>" />
<input type="hidden" name="event_id" value="<?php echo $event->id;?>" />

<ul id="form" class="form">
	<li><h1>Agenda > Editar</h1></li>
	<!-- -->
	<li><h1>Info</h1></li>
	<li><strong>Evento: </strong><?php echo $event->name;?></li>
	<li>
		<label>Tipo *</label><br/>
		<select name="type" required>
			<?php 
			$results = $Agenda->types(); 
			foreach ($results as $res):
			$opt = ($info->type == $res->key ? $sy : $sn); ?>
			<option <?php echo $opt;?> value="<?php echo $res->key;?>"><?php echo $res->label;?></option>
			<?php 
			endforeach; ?>
		</select>
	</li>
	<li>
		<label>Vincular um palestrante?</label><br/>
		<select name="panelist_id">
			<option value="0">Não vincular</option>
			<?php 
			$results = $Panelists->forEvent($event->id); 
			foreach ($results as $res): $res = (object) $res; 
			$opt = ($info->panelist_id == $res->id ? $sy : $sn); ?>
			<option <?php echo $opt;?> value="<?php echo $res->id;?>"><?php echo $res->name;?></option>
			<?php 
			endforeach; ?>
		</select>
	</li>
	<li>
		<label>Data *</label><br/>
		<select name="date">
			<?php 
			$p = 0;
			$dates = explode("|", $event->info_dates);
			foreach($dates as $date): 
			$opt = ($info->date == $p ? $sy : $sn); ?>
			<option <?php echo $opt;?> value="<?php echo $p;?>"><?php echo $date;?></option>
			<?php 
			$p++;
			endforeach; ?>
		</select>
	</li>
	<?php 
	$h1 = explode(" ", $info->date_start);
	$h2 = explode(" ", $info->date_end);
	$hstart = substr($h1[1], 0, 5);
	$hend = substr($h2[1], 0, 5); ?>
	<li>
		<label>Horário de início *</label><br/>
		<input type="text" name="hour_start" class="hour" required value="<?php echo $hstart;?>" />
	</li>
	<li>
		<label>Horário de final *</label><br/>
		<input type="text" name="hour_end" class="hour" required value="<?php echo $hend;?>" />
	</li>
	<li><h1>Para Palestrantes</h1></li>
	<li>
		<label>Título do Tema da Palestra</label><br/>
		<input type="text" name="theme_title" maxlength="50" value="<?php echo $info->theme_title;?>" />
	</li>
	<li>
		<label>Tema da Palestra</label><br/>
		<textarea name="theme_description"><?php echo $info->theme_description;?></textarea>
	</li>
	<li><h1>Para Pausas e Sessões Especiais</h1></li>
	<li>
		<label>Título</label><br/>
		<input type="text" name="label" maxlength="50" value="<?php echo $info->label;?>" />
	</li>
	<li>
		<label>Subtítulo</label><br/>
		<input type="text" name="sublabel" maxlength="50" value="<?php echo $info->sublabel;?>" />
	</li>
	<!-- -->
	<li><button>EDITAR</button></li>
</ul>
</form>

<?php
# ...
get_footer(''); ?>