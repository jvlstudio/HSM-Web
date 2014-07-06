<?php global $me;?>
<div id="topbar">Olá <?php echo $me->name;?> (<a href="<?php permalink("/backend/sign/log-out");?>">sair</a>)</div>
<ul id="menu">
	<li><a href="<?php permalink('/backend/events');?>"><i class="fa fa-calendar"></i><br/><span>Eventos</span></a></li>
	<li><a href="<?php permalink('/backend/agenda');?>"><i class="fa fa-ticket"></i><br/><span>Agenda</span></a></li>
	<li><a href="<?php permalink('/backend/panelists');?>"><i class="fa fa-user-md"></i><br/><span>Palestrantes</span></a></li>
	<li><a href="<?php permalink('/backend/passes');?>"><i class="fa fa-ticket"></i><br/><span>Passes</span></a></li>
	<li><a href="<?php permalink('/backend/books');?>"><i class="fa fa-book"></i><br/><span>Livros</span></a></li>
	<li><a href="<?php permalink('/backend/magazines');?>"><i class="fa fa-bookmark-o"></i><br/><span>Revistas</span></a></li>
	<li><a href="<?php permalink('/backend/users');?>"><i class="fa fa-group"></i><br/><span>Usuários</span></a></li>
</ul>