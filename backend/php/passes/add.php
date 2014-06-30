<?php
# ...
get_header(''); ?>

<form method="post" action="<?php permalink("/backend/{$args->dir}/handle");?>" id="form_values">
<input type="hidden" name="scope" value="<?php echo $args->page;?>" />
<ul id="form" class="form">
	<li><h1>Passes > Adicionar</h1></li>
	<!-- -->
	<li><h1>Info</h1></li>
	<li>
		<label>Nome</label><br/>
		<input type="text" name="name" required value="" />
	</li>
	<li>
		<label>Evento *</label><br/>
		<select name="event_id" required>
			<?php 
			$results = $Events->select("ORDER BY name ASC"); 
			foreach ($results as $res): $res = (object) $res; ?>
			<option value="<?php echo $res->id;?>"><?php echo $res->name;?></option>
			<?php 
			endforeach; ?>
		</select>
	</li>
	<li>
		<label>Cor do passe *</label><br/>
		<select name="color" required>
			<?php 
			$results = $Passes->colors(); 
			foreach ($results as $res): ?>
			<option value="<?php echo $res->slug;?>"><?php echo $res->label;?></option>
			<?php 
			endforeach; ?>
		</select>
	</li>
	<li>
		<label>Preço original *</label><br/>
		<input type="text" name="price_from" class="money" required />
	</li>
	<li>
		<label>Preço promocional *</label><br/>
		<input type="text" name="price_to" class="money" required />
	</li>
	<li>
		<label>Válido até</label><br/>
		<input type="text" name="valid_to" class="date_mask" />
	</li>
	<li>
		<label>Descrição *</label><br/>
		<input type="text" name="description" maxlength="70" required />
	</li>
	<li>
		<label>Dias *</label><br/>
		<select name="days" required>
			<?php 
			$results = $Passes->days(); 
			foreach ($results as $res): ?>
			<option value="<?php echo $res->slug;?>"><?php echo $res->label;?></option>
			<?php 
			endforeach; ?>
		</select>
	</li>
	<li>
		<label>Deixar usuário escolher a data?</label><br/>
		<select name="show_dates" required>
			<option value="kYes">Sim</option>
			<option value="kNo">Não</option>
		</select>
	</li>
	<li>
		<label>Permitir o cadastro de mais de um usuário?</label><br/>
		<select name="is_multiple" required>
			<option value="kYes">Sim</option>
			<option value="kNo">Não</option>
		</select>
	</li>
	<li>
		<label>E-mail para receber a compra *</label><br/>
		<input type="text" name="email" maxlength="100" required />
	</li>
	<!-- -->
	<li><button>ADICIONAR</button></li>
</ul>
</form>

<?php
# ...
get_footer(''); ?>