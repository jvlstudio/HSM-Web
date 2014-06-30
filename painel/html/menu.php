<?php 
$sel = "selected";
$home_selected = ($args->dir == "home" ? $sel : "");
# ...
$events_selected = ($args->dir == "events" ? $sel : "");
$show = ($args->dir == "events" ? "style=\"display:block\"" : "");
# ...
$books_selected = ($args->dir == "books" ? $sel : "");
$bshow = ($args->dir == "books" ? "style=\"display:block\"" : "");
# ...
$zines_selected = ($args->dir == "magazines" ? $sel : "");
$zshow = ($args->dir == "magazines" ? "style=\"display:block\"" : "");
$s1 = $s2 = $s3 = $s4 = $s5 = "";
switch ($args->page) {
	case "infos":
		$s1 = $sel; break;
	case "panelists":
		$s2 = $sel; break;
	case "speechs":
		$s3 = $sel; break;
	case "agenda":
		$s4 = $sel; break;
	case "passes":
		$s5 = $sel; break;
} ?>

<!-- topbar -->
<li>
<table>
	<tr>
		<td width="70" align="center"><img src="<?php echo PAINEL_IMAGES;?>/menu.png" alt="" /></td>
		<td width="150" align="center"><img src="<?php echo PAINEL_IMAGES;?>/logo_hsm.png" alt="" /></td>
	</tr>
</table>
</li>

<!-- home -->
<li menu="home" class="menu_option <?php echo $home_selected;?>" url="home" style="margin-top: 50px;">
<table>
	<tr>
		<td width="70" align="center"><img src="<?php echo PAINEL_IMAGES;?>/menu_home.png" alt="" /></td>
		<td width="180">Home</td>
		<td width="50" align="center"><i class="fa fa-chevron-down"></i></td>
	</tr>
</table>
</li>
<!-- events -->
<li menu="events" class="menu_option <?php echo $events_selected;?>">
<table>
	<tr>
		<td width="70" align="center"><img src="<?php echo PAINEL_IMAGES;?>/menu_events.png" alt="" /></td>
		<td width="180">Eventos</td>
		<td width="50" align="center"><i class="fa fa-chevron-down"></i></td>
	</tr>
</table>
</li>
	<!-- submenu -->
	<ul supermenu="events" class="submenu <?php echo $events_selected;?>" <?php echo $show;?>>
		<!-- add -->
		<li menu="<?php echo $event->slug;?>" class="submenu_option action_submenu_add" action-url="events/add">
		<table>
			<tr>
				<td width="70" align="center"><i class="fa fa-plus"></i></td>
				<td width="180">Adicionar Evento</td>
				<td width="50" align="center">&nbsp;</td>
			</tr>
		</table>
		</li>
		<!-- ... -->
		<?php 
		global $Events;
		$res = $Events->select();
		foreach($res as $event): $event = (object) $event;
		$subev = ($args->id == $event->id ? "selected" : "");
		$dshow = ($args->id == $event->id ? "style=\"display:block\"" : ""); ?>
		<li menu="<?php echo $event->slug;?>" class="submenu_option <?php echo $subev;?>">
		<table>
			<tr>
				<td width="70" align="center"><i class="fa fa-circle-o"></i></td>
				<td width="180"><?php echo minimumLabel($event->name, 20);?></td>
				<td width="50" align="center"><i class="fa fa-chevron-right"></i></td>
			</tr>
		</table>
		</li>
		<!-- downmenu -->
		<ul supermenu="<?php echo $event->slug ?>" class="downmenu" <?php echo $dshow;?>>
			<!-- infos -->
			<li class="downmenu_option <?php echo $s1;?>" url="events/infos/<?php echo $event->id;?>">
			<table>
				<tr>
					<td width="50" align="center"><i class="fa fa-circle-o"></i></td>
					<td width="150">Infos Gerais</td>
					<td width="50" align="center"><i class="fa fa-chevron-right"></i></td>
				</tr>
			</table>
			</li>
			<!-- panelists -->
			<li class="downmenu_option <?php echo $s2;?>" url="events/panelists/<?php echo $event->id;?>">
			<table>
				<tr>
					<td width="50" align="center"><i class="fa fa-circle-o"></i></td>
					<td width="150">Palestrantes</td>
					<td width="50" align="center"><i class="fa fa-chevron-right"></i></td>
				</tr>
			</table>
			</li>
			<!-- speechs 
			<li class="downmenu_option <?php echo $s3;?>" url="events/speechs/<?php echo $event->slug;?>">
			<table>
				<tr>
					<td width="50" align="center"><i class="fa fa-circle-o"></i></td>
					<td width="150">Palestras</td>
					<td width="50" align="center"><i class="fa fa-chevron-right"></i></td>
				</tr>
			</table>
			</li>-->
			<!-- agenda -->
			<li class="downmenu_option <?php echo $s4;?>" url="events/agenda/<?php echo $event->id;?>">
			<table>
				<tr>
					<td width="50" align="center"><i class="fa fa-circle-o"></i></td>
					<td width="150">Agenda</td>
					<td width="50" align="center"><i class="fa fa-chevron-right"></i></td>
				</tr>
			</table>
			</li>
			<!-- passes -->
			<li class="downmenu_option <?php echo $s5;?>" url="events/passes/<?php echo $event->id;?>">
			<table>
				<tr>
					<td width="50" align="center"><i class="fa fa-circle-o"></i></td>
					<td width="150">Passes</td>
					<td width="50" align="center"><i class="fa fa-chevron-right"></i></td>
				</tr>
			</table>
			</li>
		</ul>
		<?php 
		endforeach; ?>
	</ul>
<!-- books -->
<li menu="books" class="menu_option">
<table>
	<tr>
		<td width="70" align="center"><img src="<?php echo PAINEL_IMAGES;?>/menu_books.png" alt="" /></td>
		<td width="180">Livros</td>
		<td width="50" align="center"><i class="fa fa-chevron-down"></i></td>
	</tr>
</table>
</li>
	<!-- submenu -->
	<ul supermenu="books" class="submenu <?php echo $books_selected;?>" <?php echo $bshow;?>>
		<!-- add -->
		<li menu="books" class="submenu_option action_submenu_add" action-url="books/add">
		<table>
			<tr>
				<td width="70" align="center"><i class="fa fa-plus"></i></td>
				<td width="180">Adicionar Livro</td>
				<td width="50" align="center">&nbsp;</td>
			</tr>
		</table>
		</li>
		<!-- ... -->
		<?php 
		global $Books;
		$res = $Books->select("ORDER BY id DESC");
		foreach($res as $event): $event = (object) $event;
		$subev = ($args->id == $event->slug ? "selected" : "");
		$dshow = ($args->id == $event->slug ? "style=\"display:block\"" : ""); ?>
		<li menu="<?php echo $event->slug;?>" class="submenu_option <?php echo $subev;?>" url="books/details/<?php echo $event->id;?>">
		<table>
			<tr>
				<td width="70" align="center"><i class="fa fa-circle-o"></i></td>
				<td width="180"><?php echo minimumLabel($event->name, 20);?></td>
				<td width="50" align="center"><i class="fa fa-chevron-right"></i></td>
			</tr>
		</table>
		</li>
		<?php 
		endforeach; ?>
	</ul>
<!-- magazines -->
<li menu="magazines" class="menu_option">
<table>
	<tr>
		<td width="70" align="center"><img src="<?php echo PAINEL_IMAGES;?>/menu_magazines.png" alt="" /></td>
		<td width="180">Revistas</td>
		<td width="50" align="center"><i class="fa fa-chevron-down"></i></td>
	</tr>
</table>
</li>
	<!-- submenu -->
	<ul supermenu="magazines" class="submenu <?php echo $zines_selected;?>" <?php echo $zshow;?>>
		<!-- add -->
		<li menu="magazines" class="submenu_option action_submenu_add" action-url="magazines/add">
		<table>
			<tr>
				<td width="70" align="center"><i class="fa fa-plus"></i></td>
				<td width="180">Adicionar Revista</td>
				<td width="50" align="center">&nbsp;</td>
			</tr>
		</table>
		</li>
		<!-- ... -->
		<?php 
		global $Magazines;
		$res = $Magazines->select("ORDER BY name ASC");
		foreach($res as $event): $event = (object) $event;
		$subev = ($args->id == $event->slug ? "selected" : "");
		$dshow = ($args->id == $event->slug ? "style=\"display:block\"" : ""); ?>
		<li menu="<?php echo $event->slug;?>" class="submenu_option <?php echo $subev;?>" url="magazines/details/<?php echo $event->id;?>">
		<table>
			<tr>
				<td width="70" align="center"><i class="fa fa-circle-o"></i></td>
				<td width="180"><?php echo minimumLabel($event->name, 20);?></td>
				<td width="50" align="center"><i class="fa fa-chevron-right"></i></td>
			</tr>
		</table>
		</li>
		<?php 
		endforeach; ?>
	</ul>