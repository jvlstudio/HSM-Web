<?php
# ...
get_header(""); ?>

<?php 
# ...
$info = $Events->forId($args->id); ?>

<h1 class="title">Palestras &bull; <?php echo minimumLabel($info->name, 30);?></h1>

<!-- boxes -->
<div id="boxes">

	<?php 
	# ...
	$objs = $Passes->forEventSlug($info->slug);
	foreach ($objs as $obj): $obj = (object) $obj; ?>
	<!-- box -->
	<div class="box">
		<h3 class="subtitle bullet">Passe <?php echo $Passes->labelForColor($obj->color);?></h3>
		<!-- data -->
		<ul class="datas">
			<li class="data">
				<h5 class="downtitle">Validade</h5>
				<h5 class="downvalue"><span><?php echo $obj->description;?></span></h5>
			</li>
			<li class="data">
				<h5 class="downtitle">Preço normal</h5>
				<h5 class="downvalue"><span>R$ <?php echo $obj->price_from;?></span></h5>
			</li>
			<li class="data">
				<h5 class="downtitle">Preço no app</h5>
				<h5 class="downvalue"><span>R$ <?php echo $obj->price_to;?></span></h5>
			</li>
		</ul>
		<div class="edit"><div class="icon" page="edit"></div></div>
		<div class="clear"></div>
	</div>
	<?php 
	# ...
	endforeach; ?>
	
</div>
<div class="clear"></div>

<?php
# ...
get_footer(""); ?>