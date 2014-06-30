<?php global $me;?>
<div id="topbar">
	Olá <?php echo $me->name;?> (<a href="<?php permalink("/midia/sign/log-out");?>">sair</a>)
	<div class="right"><span id="online"></span></div>
</div>
<ul id="menu">
	<li><a href="<?php permalink('/midia/clients');?>"><i class="fa fa-smile-o"></i><br/><span>Clientes</span></a></li>
	<li><a href="<?php permalink('/midia/ads');?>"><i class="fa fa-chain"></i><br/><span>Campanhas</span></a></li>
</ul>