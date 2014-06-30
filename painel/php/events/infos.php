<?php
# ...
get_header(""); ?>

<?php 
# ...
$info = $Events->forId($args->id); ?>

<h1 class="title">
	Infos Gerais &bull; <?php echo minimumLabel($info->name, 25);?>
	<span class="action_times action_remove" data-id="<?php echo $args->id;?>"></span>
</h1>

<!-- boxes -->
<div id="boxes" class="large">

	<!-- box -->
	<div class="box">
		<h3 class="subtitle bullet">Informações Gerais</h3>
		<!-- data -->
		<ul class="datas">
			<li class="data">
				<h5 class="downtitle">Nome do evento</h5>
				<h5 class="downvalue"><span><?php echo $info->name;?></span></h5>
			</li>
			<li class="data">
				<h5 class="downtitle">Dia</h5>
				<h5 class="downvalue"><span><?php echo $info->info_dates;?></span></h5>
			</li>
			<li class="data">
				<h5 class="downtitle">Hora</h5>
				<h5 class="downvalue"><span><?php echo $info->info_hours;?></span></h5>
			</li>
			<li class="data">
				<h5 class="downtitle">Local</h5>
				<h5 class="downvalue"><span><?php echo $info->info_locale;?></span></h5>
			</li>
			<li class="data">
				<h5 class="downtitle">Descrição</h5>
				<h5 class="downvalue"><span><?php echo $info->description;?></span></h5>
			</li>
		</ul>
		<div class="edit"><div class="icon" page="edit/<?php echo $args->id;?>"></div></div>
		<div class="clear"></div>
	</div>
	
</div>
<div class="clear"></div>

<?php
# ...
get_footer(""); ?>