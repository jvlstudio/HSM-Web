<?php
# ...
get_header(''); ?>

<form method="post" action="<?php permalink("/backend/{$args->dir}/handle");?>" id="form_values" enctype="multipart/form-data">
<input type="hidden" name="scope" value="<?php echo $args->page;?>" />
<ul id="form" class="form">
	<li><h1>Eventos > Adicionar</h1></li>
	<!-- -->
	<li><h1>Info</h1></li>
	<li>
		<label>Nome do Evento *</label><br/>
		<input type="text" name="name" maxlength="50" required />
	</li>
	<li>
		<label>Slug</label><br/>
		<input type="text" name="slug" maxlength="50" />
	</li>
	<li>
		<label>Descrição</label><br/>
		<textarea name="description"></textarea>
	</li>
	<li>
		<label>Resumo (Pequena Descrição)</label><br/>
		<input type="text" name="tiny_description" maxlength="200" />
	</li>
	<li>
		<label>Datas</label><br/>
		<div id="dates_wrap">
	 		<div><input type="text" name="info_dates[]" class="date_pick" /></div>
		</div>
		<div class="button adddate" style="width: 100px;"><i class="fa fa-plus"></i> Adicionar data</div>
	</li>
	<li>
		<label>Horário</label><br/>
		<input type="text" name="info_hours" maxlength="50" />
	</li>
	<li>
		<label>Local</label><br/>
		<input type="text" name="info_locale" maxlength="50" />
	</li>
	<li><h1>Imagens</h1></li>
	<li>
		<label>Imagem para Lista</label><br/>
		<input type="file" name="image_list" />
	</li>
	<li>
		<label>Imagem para Single</label><br/>
		<input type="file" name="image_single" />
	</li>
	<!-- -->
	<li><button>ADICIONAR</button></li>
</ul>
</form>

<?php
# ...
get_footer(''); ?>