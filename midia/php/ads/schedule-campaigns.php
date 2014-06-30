<?php
# ...
$results = $Ads->clients();
# ...
get_header(''); ?>

<ul class="form">
	<li><a href="<?php permalink("/midia/{$args->dir}/add-campaign");?>">[+] Adicionar nova campanha</a></li>
	<li><a href="<?php permalink("/midia/{$args->dir}");?>">[+] Lista de campanhas</a></li>
</ul>

<script type="text/javascript">
$(function(){
	$('#calendar').fullCalendar({
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},
		editable: false,
		events: [
		<?php
			$res = $Ads->campaigns();
			$arr = array();
			foreach ($res as $obj):
			
				$obj = (object) $obj;
				$dstart = dateObject($obj->date_start);
				$dend	= dateObject($obj->date_end);
				
				// javascript index begin at 0
				$dstart->month	-= 1;
				$dend->month	-= 1;
				
				$info			= new stdClass;
				$info->title 	= $obj->name;
				$info->start	= "new Date({$dstart->year}, {$dstart->month}, {$dstart->day})";
				$info->end		= "new Date({$dend->year}, {$dend->month}, {$dend->day})";
				$info->url		= permalink("/midia/{$args->dir}/edit-campaign/{$obj->id}", false);
				
				$str			= "{ title: '{$info->title}', start: {$info->start}, end: {$info->end}, url: '{$info->url}' }";
				$arr[] = $str;
				
			endforeach;
			
			$result = implode(", ", $arr);
			echo $result;
		?>
		]
	});
});
</script>

<ul id="form" class="form">
	<h1 class="pb10">Calendário de Campanhas</h1>
	<div id="calendar"></div>
</ul>

<?php
# ...
get_footer(''); ?>