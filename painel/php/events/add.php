<?php 
# header..
get_header("", "-empty"); ?>

<style>body { background: white; }</style>

<form method="post" action="<?php permalink("/painel/{$args->dir}/handle");?>" id="form_values" enctype="multipart/form-data">
<input type="hidden" name="scope" value="<?php echo $args->page;?>" />

<div id="form">

	<h1>Novo Evento</h1>
	<ul class="fields">
		<li>
			<input type="text" name="name" class="textfield required" watermark="Nome do evento" />
		</li>
		<li>
			<textarea class="textfield" name="description" watermark="Descrição"></textarea>
		</li>
		<li>
			<input type="text" name="tiny_description" class="textfield required" watermark="Pequena descrição" />
		</li>
		<li>
			<input type="text" name="info_locale" class="textfield required" watermark="Local do evento" />
		</li>
	</ul>
	<h1>Data/Horário</h1>
	<ul class="fields">
		<li>
			<ul class="event_dates">
				<li class="left more_dates">
					<div><input type="text" name="info_dates[]" class="textfield date_pick" watermark="Datas do evento" style="width: 90%;" /></div>
				</li>
				<li class="right"><div class="button blue adddate"><i class="fa fa-plus"></i> Adicionar data</div></li>
				<div class="clear"></div>
			</ul>
		</li>
		<li>
			<input type="text" name="info_hours" class="textfield required" watermark="Horário do evento" />
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