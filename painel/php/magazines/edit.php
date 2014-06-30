<?php 
# header..
get_header("", "-empty"); ?>

<?php 
# months..
$months	= array("Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro");
$info = $Magazines->forId($args->id);
$thismonth	= explode("/", $info->description);
$sel = "selected=\"selected\""; ?>

<style>body { background: white; }</style>

<form method="post" action="<?php permalink("/painel/{$args->dir}/handle");?>" id="form_values" enctype="multipart/form-data">
<input type="hidden" name="scope" value="<?php echo $args->page;?>" />
<input type="hidden" name="id" value="<?php echo $args->id;?>" />

<div id="form">
	<h1>Revistas</h1>
	<ul class="fields">
		<li>
			<div id="fileinput_image" class="textfield filefield" label="Imagem PNG (119x158)">
				<input type="file" name="image" />
				<span></span>
				<i class="fa fa-picture-o"></i>
			</div>
			<input type="hidden" name="image_width" value="119" />
			<input type="hidden" name="image_height" value="158" />
		</li>
		<li>
			<input type="text" name="name" class="textfield required" watermark="Número da edição" value="<?php echo $info->name;?>" />
		</li>
		<li>
			<select name="period_from" class="textfield required">
				<option value="">Mês de Início</option>
				<?php 
				foreach ($months as $month):
				$s = ($thismonth[0] == $month ? $sel : ""); ?>
				<option <?php echo $s;?> value="<?php echo $month;?>"><?php echo $month;?></option>
				<?php 
				endforeach; ?>
			</select>
		</li>
		<li>
			<select name="period_to" class="textfield required">
				<option value="">Mês de Término</option>
				<?php 
				foreach ($months as $month):
				$s = ($thismonth[1] == $month ? $sel : ""); ?>
				<option <?php echo $s;?> value="<?php echo $month;?>"><?php echo $month;?></option>
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