<?php
# ...
get_header(''); ?>

<form method="post" action="<?php permalink("/midia/{$args->dir}/handle");?>" id="form_values">
<input type="hidden" name="scope" value="<?php echo $args->page;?>" />
<ul id="form" class="form">
	<li><h1>Mídia > Adicionar Campanha</h1></li>
	
	<!-- -->
	<li>
		<label>Cliente</label><br/>
		<select name="client_id">
			<option value="0">Nenhum</option>
			<?php 
			$r = 0;
			$results = $Ads->clients(); 
			foreach ($results as $res): $res = (object) $res; ?>
			<option value="<?php echo $res->id;?>"><?php echo $res->name;?></option>
			<?php 
			endforeach; ?>
		</select>
	</li>
	
	<!-- -->
	<li><h1>Informações</h1></li>
	<li>
		<label>Nome *</label><br/>
		<input type="text" name="name" required id="ipt_name" value="" />
		<div>Máximo: <span id="ipt_name_counter"></span></div>
	</li>
	
	<!-- -->
	<li><h1>Datas</h1></li>
	<li>
		<label>Data de início *</label><br/>
		<input type="text" name="date_start" id="ipt_date_start" required />
	</li>
	<li>
		<label>Data de término *</label><br/>
		<input type="text" name="date_end" id="ipt_date_end" required />
	</li>
	
	<!-- -->
	<li><h1>Horários</h1></li>
	<li>
		<label>Horário de início (referente a data de início)*</label><br/>
		<input type="text" name="hour_start" class="hour" required />
	</li>
	<li>
		<label>Data de término (referente a data de término)*</label><br/>
		<input type="text" name="hour_end" class="hour" required />
	</li>
	
	<!-- 
	<li><h1>Segmentações</h1></li>
	<li>
		<label>Sexo</label>
		<input type="radio" name="opt[gender]" id="gender_male" value="male" />
		<label for="gender_male">Masculino</label>
		<input type="radio" name="opt[gender]" id="gender_female" value="female" />
		<label for="gender_female">Feminino</label>
		<input type="radio" name="opt[gender]" id="gender_all" value="all" checked="checked" />
		<label for="gender_all">Ambos</label>
	</li>
	<li>
		<label>Idade (deixe vazio para contemplar todas as idades)</label><br/>
		<label>de</label>
		<input type="text" name="opt[age_start]" style="width: 50px;" maxlength="2" />
		<label>a</label>
		<input type="text" name="opt[age_end]" style="width: 50px;" maxlength="2" />
	</li>
	
	 -->
	<li><button>ADICIONAR</button></li>
</ul>
</form>

<?php
# ...
get_footer(''); ?>