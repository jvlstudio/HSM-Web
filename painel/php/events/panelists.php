<?php
# ...
get_header(""); ?>

<?php 
# ...
$info = $Events->forId($args->id); ?>

<h1 class="title"> Palestrantes &bull; <?php echo minimumLabel($info->name, 30);?> <span class="action_plus" page="add-panelists"></span></h1>

<!-- boxes -->
<div id="boxes" class="large">

	<?php 
	# ...
	$p = 1;
	$objs = $Panelists->select();
	foreach ($objs as $obj): $obj = (object) $obj; ?>
	<!-- box -->
	<div class="box">
		<h3 class="subtitle bullet">Palestrante <?php echo $p;?></h3>
		<!-- data -->
		<ul class="datas">
			<li class="data">
				<h5 class="downtitle">Nome</h5>
				<h5 class="downvalue"><span><?php echo $obj->name;?></span></h5>
			</li>
			<li class="data">
				<h5 class="downtitle">Descrição</h5>
				<h5 class="downvalue"><span><?php echo $obj->description;?></span></h5>
			</li>
			<li class="data">
				<h5 class="downtitle">Foto</h5>
				<ul class="images">
					<li class="ios">
						<img src="<?php echo PAINEL_IMAGES;?>/img_ios.png" alt="" />
						<p>1000px x 1000px</p>
					</li>
					<div class="clear"></div>
				</ul>
			</li>
		</ul>
		<div class="edit"><div class="icon" page="edit-panelists/<?php echo $obj->id;?>"></div></div>
		<div class="clear"></div>
	</div>
	<?php 
	# ...
	$p++;
	endforeach; ?>
	
</div>
<div class="clear"></div>

<?php
# ...
get_footer(""); ?>