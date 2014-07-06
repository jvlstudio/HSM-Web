<?php
# ...
get_header(''); ?>

<form method="post" action="<?php permalink("/backend/{$args->dir}/handle");?>" id="form_values" enctype="multipart/form-data">
<input type="hidden" name="scope" value="<?php echo $args->page;?>" />
<ul id="form" class="form">
	<li><h1>Livros > Adicionar</h1></li>
	<!-- -->
	<li><h1>Info</h1></li>
	<li>
		<label>Nome do Livro *</label><br/>
		<input type="text" name="name" maxlength="50" required />
	</li>
	<li>
		<label>Descrição *</label><br/>
		<textarea name="description" required></textarea>
	</li><!--
	<li>
		<label>Resumo (Pequena Descrição)</label><br/>
		<input type="text" name="tiny_description" maxlength="200" />
	</li>-->
	<li>
		<label>Imagem</label><br/>
		<input type="file" name="picture" />
	</li>
	<li>
		<label>Link para compra</label><br/>
		<input type="text" name="link" maxlength="200" />
	</li>
	<li><h1>Autor</h1></li>
	<li>
		<label>Nome *</label><br/>
		<input type="text" name="author_name" maxlength="100" required />
	</li>
	<li>
		<label>Descrição *</label><br/>
		<textarea name="author_description" required></textarea>
	</li>
	<!-- -->
	<li><button>ADICIONAR</button></li>
</ul>
</form>

<?php
# ...
get_footer(''); ?>