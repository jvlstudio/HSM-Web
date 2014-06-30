<?php
# ...
$info = (object) $Passes->forId($target_id);
$sy = 'selected="selected"'; $sn = "";

# ...
get_header(''); ?>

<form method="post" action="<?php permalink("/backend/{$args->dir}/handle");?>" id="form_values">
<input type="hidden" name="scope" value="<?php echo $args->page;?>" />
<input type="hidden" name="id" value="<?php echo $target_id;?>" />

<ul id="form" class="form">
	<li><h1>Usuários > Editar</h1></li>
	<!-- -->
	<li><h1>Info</h1></li>
	<li>
		<label>Nome</label><br/>
		<input type="text" name="name" required value="<?php echo $info->name;?>" />
	</li>
	<li>
		<label>Evento *</label><br/>
		<select name="event_id" required>
			<?php 
			$results = $Events->select("ORDER BY name ASC"); 
			foreach ($results as $res): 
			$res = (object) $res;
			$opt1 = ($res->slug == $info->event_slug ? $sy : $sn); ?>
			<option <?php echo $opt1;?> value="<?php echo $res->id;?>"><?php echo $res->name;?></option>
			<?php 
			endforeach; ?>
		</select>
	</li>
	<li>
		<label>Cor do passe *</label><br/>
		<select name="color" required>
			<?php 
			$results = $Passes->colors(); 
			foreach ($results as $res):
			$opt2 = ($res->slug == $info->color ? $sy : $sn); ?>
			<option <?php echo $opt2;?> value="<?php echo $res->slug;?>"><?php echo $res->label;?></option>
			<?php 
			endforeach; ?>
		</select>
	</li>
	<li>
		<label>Preço original *</label><br/>
		<input type="text" name="price_from" class="money" required value="<?php echo $info->price_from;?>" />
	</li>
	<li>
		<label>Preço promocional *</label><br/>
		<input type="text" name="price_to" class="money" required value="<?php echo $info->price_to;?>" />
	</li>
	<li>
		<label>Válido até</label><br/>
		<input type="text" name="valid_to" class="date_mask" value="<?php echo $info->valid_to;?>" />
	</li>
	<li>
		<label>Descrição *</label><br/>
		<input type="text" name="description" maxlength="70" required value="<?php echo $info->description;?>" />
	</li>
	<li>
		<label>Dias *</label><br/>
		<select name="days" required>
			<?php 
			$results = $Passes->days(); 
			foreach ($results as $res):
			$opt3 = ($res->slug == $info->days ? $sy : $sn); ?>
			<option <?php echo $opt3;?> value="<?php echo $res->slug;?>"><?php echo $res->label;?></option>
			<?php 
			endforeach; ?>
		</select>
	</li>
	<li>
		<label>Deixar usuário escolher a data?</label><br/>
		<?php 
		$vy = $vn = "";
		$info->show_dates == "kYes" ? $vy = $sy : $vn = $sy; ?>
		<select name="show_dates" required>
			<option value="kYes" <?php echo $vy;?>>Sim</option>
			<option value="kNo" <?php echo $vn;?>>Não</option>
		</select>
	</li>
	<li>
		<label>Permitir o cadastro de mais de um usuário?</label><br/>
		<?php 
		$vy = $vn = "";
		$info->is_multiple == "kYes" ? $vy = $sy : $vn = $sy; ?>
		<select name="is_multiple" required>
			<option value="kYes" <?php echo $vy;?>>Sim</option>
			<option value="kNo" <?php echo $vn;?>>Não</option>
		</select>
	</li>
	<li>
		<label>E-mail para receber a compra *</label><br/>
		<input type="text" name="email" maxlength="100" required value="<?php echo $info->email;?>" />
	</li>
	<!-- -->
	<li><button>EDITAR</button></li>
</ul>
</form>

<?php
# ...
get_footer(''); ?>