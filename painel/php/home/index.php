<?php
# ...
get_header(""); ?>

<?php 
# ...
$info = (array) $Home->get(); ?>

<h1 class="title">Home</h1>

<!-- boxes -->
<div id="boxes">
	
	<?php 
	$models = array((object) array("slug" => "events", "label" => "Eventos"),
					(object) array("slug" => "education", "label" => "Educação"),
					(object) array("slug" => "videos", "label" => "HSM Vídeos"),
					(object) array("slug" => "magazines", "label" => "Revistas HSM"),
					(object) array("slug" => "books", "label" => "HSM Editora"));
	foreach($models as $model):				
	?>
	<!-- box -->
	<div class="box">
		<h3 class="subtitle <?php echo $model->slug;?>"><?php echo $model->label;?></h3>
		<!-- data -->
		<ul class="datas">
			<li class="data">
				<h5 class="downtitle">Título (Chamada)</h5>
				<h5 class="downvalue"><span><?php echo $info[$model->slug."_title"];?></span></h5>
			</li>
			<li class="data">
				<h5 class="downtitle">Imagens</h5>
				<ul class="images">
					<li class="ios">
						<img src="<?php echo PAINEL_IMAGES;?>/img_ios.png" alt="" />
						<p>1000px x 1000px</p>
					</li>
					<li class="android">
						<img src="<?php echo PAINEL_IMAGES;?>/img_android.png" alt="" />
						<p>1000px x 1000px</p>
					</li>
					<div class="clear"></div>
				</ul>
			</li>
		</ul>
		<div class="edit"><div class="icon" page="edit"></div></div>
		<div class="clear"></div>
	</div>
	
	<?php 
	endforeach; ?>
	
</div>
<!-- simulator 
<div id="simulator">
	<button></button>
	<div class="phone">
		
	</div>
</div>-->
<div class="clear"></div>

<?php
# ...
get_footer(""); ?>