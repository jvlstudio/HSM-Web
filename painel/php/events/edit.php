<?php 
# header..
get_header("", "-empty"); ?>

<?php 
# ...
$info = $Events->forId($args->id); ?>

<style>body { background: white; }</style>

<form method="post" action="<?php permalink("/painel/{$args->dir}/handle");?>" id="form_values" enctype="multipart/form-data">
<input type="hidden" name="scope" value="<?php echo $args->page;?>" />
<input type="hidden" name="id" value="<?php echo $args->id;?>" />

<div id="form">

	<h1>Novo Evento</h1>
	<ul class="fields">
		<li>
			<input type="text" name="name" class="textfield required" watermark="Nome do evento" value="<?php echo $info->name;?>" />
		</li>
		<li>
			<textarea class="textfield" name="description" watermark="Descrição"><?php echo $info->name;?></textarea>
		</li>
		<li>
			<input type="text" name="tiny_description" class="textfield required" watermark="Pequena descrição" value="<?php echo $info->tiny_description;?>" />
		</li>
		<li>
			<input type="text" name="info_locale" class="textfield required" watermark="Local do evento" value="<?php echo $info->info_locale;?>" />
		</li>
	</ul>
	<h1>Data/Horário</h1>
	<ul class="fields">
		<li>
			<ul class="event_dates">
				<li class="left more_dates">
					<?php 
					$p = 0;
					$dates = explode("|", $info->info_dates);
					foreach ($dates as $datestr): ?>
					<div><input type="text" name="info_dates[]" class="date_pick textfield" value="<?php echo $datestr;?>" watermark="Datas do evento" style="width: 90%;" /> <?php if($p>0):?> <i class="fa fa-times removedate datehandle"></i><?php endif;?></div>
					<?php 
					$p++;
					endforeach; ?>
				</li>
				<li class="right"><div class="button blue adddate"><i class="fa fa-plus"></i> Adicionar data</div></li>
				<div class="clear"></div>
			</ul>
		</li>
		<li>
			<input type="text" name="info_hours" class="textfield required" watermark="Horário do evento" value="<?php echo $info->info_hours;?>" />
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