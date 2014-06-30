<?php 
# header..
get_header("", "-empty"); ?>

<?php 
# ...
$info = (array) $Home->get(); ?>

<style>body { background: white; }</style>

<form method="post" action="<?php permalink("/painel/{$args->dir}/handle");?>" id="form_values" enctype="multipart/form-data">
<input type="hidden" name="scope" value="<?php echo $args->page;?>" />
<input type="hidden" name="me_id" value="<?php echo $args->id;?>" />

<div id="form">

	<?php 
	$models = array((object) array("slug" => "events", "label" => "Eventos"),
					(object) array("slug" => "education", "label" => "Educação"),
					(object) array("slug" => "videos", "label" => "HSM Vídeos"),
					(object) array("slug" => "magazines", "label" => "Revistas HSM"),
					(object) array("slug" => "books", "label" => "HSM Editora"));
	foreach($models as $model):				
	?>
	<h1><?php echo $model->label;?></h1>
	<ul class="fields">
		<li>
			<input type="text" name="<?php echo $model->slug;?>_title" class="textfield required" watermark="Título" value="<?php echo $info["{$model->slug}_title"];?>" />
		</li>
		<li>
			<div id="fileinput_<?php echo $model->slug;?>_image_ios" class="textfield filefield" label="Imagem PNG iPhone (620x344)">
				<input type="file" name="<?php echo $model->slug;?>_image_ios" />
				<span></span>
				<i class="fa fa-apple"></i>
			</div>
			<input type="hidden" name="<?php echo $model->slug;?>_image_ios_width" value="620" />
			<input type="hidden" name="<?php echo $model->slug;?>_image_ios_height" value="344" />
		</li>
		<li>
			<div id="fileinput_<?php echo $model->slug;?>_image_android" class="textfield filefield" label="Imagem PNG Android (1045x580)">
				<input type="file" name="<?php echo $model->slug;?>_image_android" />
				<span></span>
				<i class="fa fa-android"></i>
			</div>
			<input type="hidden" name="<?php echo $model->slug;?>_image_android_width" value="1045" />
			<input type="hidden" name="<?php echo $model->slug;?>_image_android_height" value="580" />
		</li>
	</ul>
	<?php 
	endforeach; ?>
	
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