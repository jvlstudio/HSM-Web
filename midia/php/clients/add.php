<?php
# ...
get_header(''); ?>

<form method="post" action="<?php permalink("/midia/{$args->dir}/handle");?>" id="form_values">
<input type="hidden" name="scope" value="<?php echo $args->page;?>" />
<ul id="form" class="form">
	<li><h1>Clientes > Adicionar</h1></li>
	<!-- -->
	<li>
		<label>Nome *</label><br/>
		<input type="text" name="name" required value="" />
	</li>
	
	<!-- -->
	<li><button>ADICIONAR</button></li>
</ul>
</form>

<?php
# ...
get_footer(''); ?>