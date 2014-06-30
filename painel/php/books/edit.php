<?php 
# header..
get_header("", "-empty"); ?>

<?php 
# ...
$info = (object) $Books->forId($args->id); ?>

<style>body { background: white; }</style>

<form method="post" action="<?php permalink("/painel/{$args->dir}/handle");?>" id="form_values" enctype="multipart/form-data">
<input type="hidden" name="scope" value="<?php echo $args->page;?>" />
<input type="hidden" name="id" value="<?php echo $args->id;?>" />

<div id="form">

	<h1>Novo Livro</h1>
	<ul class="fields">
		<li>
			<div id="fileinput_image" class="textfield filefield" label="Imagem PNG (140x190)">
				<input type="file" name="image" />
				<span></span>
				<i class="fa fa-picture-o"></i>
			</div>
			<input type="hidden" name="image_width" value="140" />
			<input type="hidden" name="image_height" value="190" />
		</li>
		<li>
			<input type="text" name="name" class="textfield required" watermark="Nome do Livro" value="<?php echo $info->name;?>" />
		</li>
		<li>
			<textarea class="textfield" name="description" watermark="Descrição"><?php echo $info->description;?></textarea>
		</li>
		<li>
			<input type="text" name="link" class="textfield required" watermark="Link" value="<?php echo $info->link;?>" />
		</li>
	</ul>
	<h1>Autor do Livro</h1>
	<ul class="fields">
		<li>
			<input type="text" name="author_name" class="textfield required" watermark="Nome do(s) Autor(es)" value="<?php echo $info->author_name;?>" />
		</li>
		<li>
			<textarea class="textfield" name="author_description" watermark="Descrição do(s) Autor(es)"><?php echo $info->author_description;?></textarea>
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