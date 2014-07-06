<?php
# ...
get_header(''); ?>

<form method="post" action="<?php permalink("/backend/{$args->dir}/handle");?>" id="form_values" enctype="multipart/form-data">
<input type="hidden" name="scope" value="<?php echo $args->page;?>" />
<ul id="form" class="form">
	<li><h1>Revistas > Adicionar</h1></li>
	<!-- -->
	<li><h1>Info</h1></li>
	<li>
		<label>Nome (Edição) *</label><br/>
		<input type="text" name="name" maxlength="70" required />
	</li>
	<li>
		<label>Descrição (Ano de publicação)*</label><br/>
		<textarea name="description" required></textarea>
	</li>
	<li>
		<label>Imagem</label><br/>
		<input type="file" name="picture" />
	</li>
	<li>
		<label>Link para compra</label><br/>
		<input type="text" name="link" maxlength="200" />
	</li>
	<!-- -->
	<li><button>ADICIONAR</button></li>
</ul>
</form>

<?php
# ...
get_footer(''); ?>