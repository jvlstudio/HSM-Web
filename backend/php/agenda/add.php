<?php
# ...
get_header('');
$event = $Events->forId($target_id); ?>

<form method="post" action="<?php permalink("/backend/{$args->dir}/handle");?>" id="form_values">
<input type="hidden" name="scope" value="<?php echo $args->page;?>" />
<input type="hidden" name="event_id" value="<?php echo $target_id;?>" />
<ul id="form" class="form">
	<li><h1>Agenda > Adicionar</h1></li>
	<!-- -->
	<li><h1>Info</h1></li>
	<li><strong>Evento: </strong><?php echo $event->name;?></li>
	<li>
		<label>Tipo *</label><br/>
		<select name="type" required>
			<?php 
			$results = $Agenda->types(); 
			foreach ($results as $res): ?>
			<option value="<?php echo $res->key;?>"><?php echo $res->label;?></option>
			<?php 
			endforeach; ?>
		</select>
	</li>
	<li>
		<label>Vincular um palestrante?</label><br/>
		<select name="panelist_id">
			<option value="0">Não vincular</option>
			<?php 
			$results = $Panelists->forEvent($target_id); 
			foreach ($results as $res): $res = (object) $res; ?>
			<option value="<?php echo $res->id;?>"><?php echo $res->name;?></option>
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
			foreach($dates as $date): ?>
			<option value="<?php echo $p;?>"><?php echo $date;?></option>
			<?php 
			$p++;
			endforeach; ?>
		</select>
	</li>
	<li>
		<label>Horário de início *</label><br/>
		<input type="text" name="hour_start" class="hour" required />
	</li>
	<li>
		<label>Horário de final *</label><br/>
		<input type="text" name="hour_end" class="hour" required />
	</li>
	<li><h1>Para Palestrantes</h1></li>
	<li>
		<label>Título do Tema da Palestra</label><br/>
		<input type="text" name="theme_title" maxlength="50" />
	</li>
	<li>
		<label>Tema da Palestra</label><br/>
		<textarea name="theme_description"></textarea>
	</li>
	<li><h1>Para Pausas e Sessões Especiais</h1></li>
	<li>
		<label>Título</label><br/>
		<input type="text" name="label" maxlength="50" />
	</li>
	<li>
		<label>Subtítulo</label><br/>
		<input type="text" name="sublabel" maxlength="50" />
	</li>
	<!-- -->
	<li><button>ADICIONAR</button></li>
</ul>
</form>

<?php
# ...
get_footer(''); ?>