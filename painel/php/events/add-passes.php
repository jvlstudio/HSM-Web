<?php 
# header..
get_header("", "-empty"); ?>


<?php 

$colors = array("green","gold","red");
$y_or_n = array("kYes","kNo");
$days = array("single","multiple");
 ?>
<style>body { background: white; }</style>

<form method="post" action="<?php permalink("/painel/{$args->dir}/handle");?>" id="form_values" enctype="multipart/form-data">
<input type="hidden" name="scope" value="<?php echo $args->page;?>" />
<input type="hidden" name="event_id" value="<?php echo $args->id;?>" />

		
<div id="form">
	<h1>Novo Passe</h1>
	<ul class="fields">
		<li>
			<textarea class="textfield" name="description" watermark="Descrição"></textarea>
		</li>
		<li>
			<input type="text" name="price_from" class="textfield required" watermark="Valor Normal"/>
		</li>
		<li>
			<input type="text" name="price_to" class="textfield required" watermark="Valor no APP"/>
		</li>
		<li>
			<input type="text" name="valid_to" class="textfield required" watermark="Validade"/>
		</li>
		<li>
			<input type="text" name="email" class="textfield required" watermark="E-mail"/>
		</li>
		<li>
			<select name="color" class="textfield required">
				<option value="">Escolha a cor do passe</option>
				<?php 
				foreach ($colors as $color):
				?>
				<option value="<?php echo $color;?>"><?php echo $color;?></option>
				<?php 
				endforeach; ?>
			</select>
		</li>
		<li>
			<select name="show_dates" class="textfield required">
				<option value="">Mostrar datas ?</option>
				<?php 
				foreach ($y_or_n as $el):
				?>
				<option value="<?php echo $el;?>"><?php echo str_replace("k", "", $el);?></option>
				<?php 
				endforeach; ?>
			</select>
		</li>
		<li>
			<select name="is_multiple" class="textfield required">
				<option value="">Deve Repetir ?</option>
				<?php 
				foreach ($y_or_n as $el):
				?>
				<option value="<?php echo $el;?>"><?php echo str_replace("k", "", $el);?></option>
				<?php 
				endforeach; ?>
			</select>
		</li>
		<li>
			<select name="days" class="textfield required">
				<option value="">Dias do Passe</option>
				<?php 
				foreach ($days as $day):
				?>
				<option value="<?php echo $day;?>"><?php echo $day;?></option>
				<?php 
				endforeach; ?>
			</select>
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