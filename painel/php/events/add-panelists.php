<?php 
# header..
get_header("", "-empty"); ?>

<style>body { background: white; }</style>

<form method="post" action="<?php permalink("/painel/{$args->dir}/handle");?>" id="form_values" enctype="multipart/form-data">
<input type="hidden" name="scope" value="<?php echo $args->page;?>" />

<div id="form">

	<h1>Novo Palestrante</h1>
	<ul class="fields">
		<li>
			<input type="text" name="name" class="textfield required" watermark="Nome do evento"" />
		</li>
		<li>
			<textarea class="textfield" name="description" watermark="Descrição"></textarea>
		</li>
		<li>
			<div id="fileinput_image" class="textfield filefield" label="Imagem PNG (1000x1000)">
				<input type="file" name="info_dates[]" />
				<span></span>
				<i class="fa fa-picture-o"></i>
			</div>
			<input type="hidden" name="image_width" value="119" />
			<input type="hidden" name="image_height" value="158" />
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