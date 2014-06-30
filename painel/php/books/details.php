<?php
# ...
get_header(""); ?>

<?php 
# ...
$info = $Books->forId($args->id); ?>

<h1 class="title">
	Livros &bull; <?php echo minimumLabel($info->name, 20);?> 
	<span class="action_times action_remove" data-id="<?php echo $args->id;?>"></span>
	<span class="action_plus"></span>
</h1>

<!-- boxes -->
<div id="boxes" class="large">

	<!-- box -->
	<div class="box">
		<h3 class="subtitle bullet">Informações Gerais</h3>
		<!-- data -->
		<ul class="datas">
			<li class="data">
				<h5 class="downtitle">Imagem</h5>
				<ul class="images">
					<li class="ios">
						<?php if($info->picture): ?>
						<img src="<?php echo HOST;?>/uploads/books/<?php echo $info->picture?>" alt="" />
						<p>140x x 190px</p>
						<?php else: ?>
						<p>Sem imagem</p>
						<?php endif; ?>
					</li>
					<div class="clear"></div>
				</ul>
			</li>
			<li class="data">
				<h5 class="downtitle">Nome do livro</h5>
				<h5 class="downvalue"><span><?php echo $info->name;?></span></h5>
			</li>
			<li class="data">
				<h5 class="downtitle">Descrição</h5>
				<h5 class="downvalue"><span><?php echo $info->description;?></span></h5>
			</li>
			<li class="data">
				<h5 class="downtitle">Autor do livro</h5>
				<h5 class="downvalue"><span><?php echo $info->author_name;?></span></h5>
			</li>
			<li class="data">
				<h5 class="downtitle">Descrição do Autor</h5>
				<h5 class="downvalue"><span><?php echo $info->author_description;?></span></h5>
			</li>
			<li class="data">
				<h5 class="downtitle">Link</h5>
				<h5 class="downvalue"><span><?php echo $info->link;?></span></h5>
			</li>
		</ul>
		<div class="edit"><div class="icon" page="edit/<?php echo $info->id;?>"></div></div>
		<div class="clear"></div>
	</div>
	
</div>
<div class="clear"></div>

<?php
# ...
get_footer(""); ?>