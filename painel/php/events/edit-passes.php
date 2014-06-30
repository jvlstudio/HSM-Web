<?php 
# header..
get_header("", "-empty"); ?>

<?php 
# ...
$info = $Passes->forId($args->id);
$colors = array("green","gold","red");
$y_or_n = array("kYes","kNo");
$days = array("single","multiple");
$sel = "selected=\"selected\""; ?>

<style>body { background: white; }</style>

<form method="post" action="<?php permalink("/painel/{$args->dir}/handle");?>" id="form_values" enctype="multipart/form-data">
<input type="hidden" name="scope" value="<?php echo $args->page;?>" />
<input type="hidden" name="id" value="<?php echo $args->id;?>" />

<div id="form">

	<h1>Editar Passe</h1>
	<ul class="fields">
		<li>
			<input type="text" name="name" class="textfield required" watermark="Nome do passe" value="<?php echo $Passes->labelForColor($info->color);?>" disabled="true" />
		</li>
		<li>
			<textarea class="textfield" name="description" watermark="Descrição"><?php echo $info->description;?></textarea>
		</li>
		<li>
			<input type="text" name="price_from" class="textfield required" watermark="Valor Normal" value="<?php echo $info->price_from;?>" />
		</li>
		<li>
			<input type="text" name="price_to" class="textfield required" watermark="Valor no APP" value="<?php echo $info->price_to;?>" />
		</li>
		<li>
			<input type="text" name="valid_to" class="textfield required" watermark="Validade" value="<?php echo $info->valid_to;?>" />
		</li>
		<li>
			<input type="text" name="email" class="textfield required" watermark="E-mail" value="<?php echo $info->email;?>" />
		</li>
		<li>
			<select name="color" class="textfield required">
				<option value="">Escolha a cor do passe</option>
				<?php 
				foreach ($colors as $color):
				$s = ($info->color == $color ? $sel : ""); ?>
				<option <?php echo $s;?> value="<?php echo $color;?>"><?php echo $color;?></option>
				<?php 
				endforeach; ?>
			</select>
		</li>
		<li>
			<select name="show_dates" class="textfield required">
				<option value="">Mostrar datas ?</option>
				<?php 
				foreach ($y_or_n as $el):
				$s = ($info->show_dates == $el ? $sel : ""); ?>
				<option <?php echo $s;?> value="<?php echo $el;?>"><?php echo str_replace("k", "", $el);?></option>
				<?php 
				endforeach; ?>
			</select>
		</li>
		<li>
			<select name="is_multiple" class="textfield required">
				<option value="">Deve Repetir ?</option>
				<?php 
				foreach ($y_or_n as $el):
				$s = ($info->is_multiple == $el ? $sel : ""); ?>
				<option <?php echo $s;?> value="<?php echo $el;?>"><?php echo str_replace("k", "", $el);?></option>
				<?php 
				endforeach; ?>
			</select>
		</li>
		<li>
			<select name="days" class="textfield required">
				<option value="">Dias do Passe</option>
				<?php 
				foreach ($days as $day):
				$s = ($info->days == $day ? $sel : ""); ?>
				<option <?php echo $s;?> value="<?php echo $day;?>"><?php echo $day;?></option>
				<?php 
				endforeach; ?>
			</select>
		</li>
	</ul>
	
	<h1>Data</h1>
	<ul class="fields">
		<li>
			<ul class="event_dates">
				<li class="left more_dates">
					<?php 
					$p = 0;
					$dates = explode("|", $info->dates);
					foreach ($dates as $datestr): ?>
					<div><input type="text" name="info_dates[]" class="date_pick textfield" value="<?php echo $datestr;?>" watermark="Datas do passe" style="width: 90%;" /> <?php if($p>0):?> <i class="fa fa-times removedate datehandle"></i><?php endif;?></div>
					<?php 
					$p++;
					endforeach; ?>
				</li>
				<li class="right"><div class="button blue adddate"><i class="fa fa-plus"></i> Adicionar data</div></li>
				<div class="clear"></div>
			</ul>
		</li>
	</ul>
		
	<ul class="fileds">	
		<li>
			<button class="blue">Enviar/Salvar</button>
		</li>
	</ul>
	
</div>

</form>

<?php 
# footer..
get_footer("", "-empty"); ?>