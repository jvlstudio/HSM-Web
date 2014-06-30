<?php
# ...
get_header(''); ?>

<form method="post" action="<?php echo ROOT;?>/midia/sign/log-in">
<input type="hidden" name="scope" value="<?php echo $args->page;?>" />
<ul id="form" class="form">
	<li><h1>Entrar</h1></li>
	<li>
		<label>Usuário</label><br/>
		<input type="text" name="ipt_user" />
	</li>
	<li>
		<label>Senha</label><br/>
		<input type="password" name="ipt_pass" />
	</li>
	<!-- -->
	<li><button>Entrar</button></li>
</ul>
</form>

<?php
# ...
title('Faça seu Login');
get_footer(''); ?>