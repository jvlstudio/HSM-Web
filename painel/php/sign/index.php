<?php
# ...
get_header("","-empty"); ?>

<script type="text/javascript">$("body").addClass("login"); $("#loader").hide();</script>
<style>body {
	background: #23232E;
}</style>

<form method="post" action="<?php echo ROOT;?>/painel/sign/log-in">
<input type="hidden" name="scope" value="<?php echo $args->page;?>" />

<div id="login">
	<p align="center"><img src="<?php echo PAINEL_IMAGES;?>/logo_hsm.png" alt="" /></p>
	<ul class="fields site">
		<li></li>
		<li>
			<input type="text" name="ipt_user" class="rounded gray" watermark="Usuário" />
		</li>
		<li>
			<input type="password" name="ipt_pass" class="rounded gray" watermark="Senha" />
		</li>
		<!-- -->
		<li class="tcenter"><button>ENVIAR</button></li>
	</ul>
</div>

</form>

<?php
# ...
get_footer("","-empty"); ?>