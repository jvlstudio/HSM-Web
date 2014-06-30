<?php
# ...
get_header(''); ?>

<form method="post" action="<?php permalink("/backend/{$args->dir}/handle");?>" id="form_values">
<input type="hidden" name="scope" value="<?php echo $args->page;?>" />
<ul id="form" class="form">
	<li><h1>Palestrantes > Adicionar</h1></li>
	<!-- -->
	<li><h1>Info</h1></li>
	<li>
		<label>Evento</label><br/>
		<select name="event_id" required>
			<?php 
			$results = $Events->select(); 
			foreach ($results as $res): $res = (object) $res; ?>
			<option value="<?php echo $res->id;?>"><?php echo $res->name;?></option>
			<?php 
			endforeach; ?>
		</select>
	</li>
	<li>
		<label>Nome *</label><br/>
		<input type="text" name="name" maxlength="50" required />
	</li>
	<li>
		<label>Descrição</label><br/>
		<textarea name="description"></textarea>
	</li>
	<!-- -->
	<li><button>ADICIONAR</button></li>
</ul>
</form>

<?php
# ...
get_footer(''); ?>