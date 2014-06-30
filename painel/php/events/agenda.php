<?php
# ...
get_header(""); ?>

<?php 
# ...
$info 	= (object) $Events->forId($args->id);
$agenda	= $Agenda->forEvent($info->id); ?>

<h1 class="title">Agenda &bull; <?php echo minimumLabel($info->name, 30);?> <span class="action_plus" page="add-agenda/<?php echo $args->id ?>"></span></h1>

<div class="regular_list">
	<?php 
	# ...
	$d = 0;
	$dates = $Events->datesFrom($info);
	foreach ($dates as $date): ?>
	<h2><?php echo $date;?></h2>
	<ul class="items">
		<?php 
		foreach ($agenda as $agendaObj):
			$agendaObj = (object) $agendaObj; 
			if($agendaObj->date == $d):
				$label = "";
				$title = "";
				$hour = $Agenda->hourFor($agendaObj);
				if($agendaObj->type != "speech"):
					$label = $agendaObj->label;
				else:
					$pan = (object) $Panelists->forId($agendaObj->panelist_id);
					$label = $pan->name;
					$title = " &bull; ".$agendaObj->theme_title;
				endif; ?>
		<li>
		<table width="100%">
			<tr>
				<td width="30"><img src="<?php echo PAINEL_IMAGES;?>/icon_ball.png" alt="" /></td>
				<td width="80" align="center"><?php echo $hour->start;?><br/><?php echo $hour->end;?></td>
				<td><p class="p-edit" page="edit-agenda/<?php echo $agendaObj->id; ?>"><?php echo $label.$title;?></p></td>
				<td width="40" align="right"><i class="fa fa-align-justify"></i></td>
			</tr>
		</table>
		</li>
		<?php 
			endif;
		endforeach; ?>
	</ul>
	<?php
		$d++;
	endforeach; ?>
	
</div>

<?php
# ...
get_footer(""); ?>