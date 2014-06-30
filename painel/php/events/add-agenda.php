<?php 
# header..
get_header("", "-empty"); ?>

<?php 
$event = $Events->forId($args->id);
$palestrantes =  $Panelists->select();
$types = array("speech","break","session");
$dates = explode("|", $event->info_dates);?>

<style>body { background: white; }</style>

<form method="post" action="<?php permalink("/painel/{$args->dir}/handle");?>" id="form_values" enctype="multipart/form-data">
<input type="hidden" name="scope" value="<?php echo $args->page;?>" />
<input type="hidden" name="event_id" value="<?php echo $args->id;?>" />

<div id="form">

	<h1>Nova Palestra</h1>
	<ul class="fields">
		<li>
			<input type="text" name="theme_title" class="textfield required" watermark="Nome da palestra" />
		</li>
		<li>
			<textarea class="textfield" name="theme_description" watermark="Descrição"></textarea>
		</li>
		<li>
			<input type="text" name="label" class="textfield required" watermark="Nome" />
		</li>
		<li>
			<input type="text" name="sublabel" class="textfield required" watermark="Local do evento" />
		</li>
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
			<select name="panelist_id" class="textfield required">
				<option value="">Escolha o palestrante</option> 
				<?php 
				foreach ($palestrantes as $palestrante):
				?>
				<option value="<?php echo $palestrante['id'];?>"><?php echo $palestrante['name'];?></option>
				<?php 
				endforeach; ?>
			</select>
		</li>
		<li>
			<select name="type" class="textfield required">
				<option value="">Tipo de palestra</option>
				<?php 
				foreach ($types as $type):
				?>
				<option value="<?php echo $type;?>"><?php echo $type;?></option>
				<?php 
				endforeach; ?>
			</select>
		</li>
	</ul>
	
	<h1>Data/Horário</h1>
	<ul class="fields">
		<li>
			<select name="date" class="textfield required">
				<option value="">Escolha o dia</option>
				<?php 
				$n = 0;
				foreach ($dates as $date):
				?>
				<option value="<?php echo $n;?>"><?php echo $date;?></option>
				<?php 
				$n++;
				endforeach; ?>
			</select>
		</li>
		<li>
			<input type="text" name="date_start" class="textfield required" watermark="Horário de início" />
		</li>
		<li>
			<input type="text" name="date_end" class="textfield required" watermark="Horário de término" />
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