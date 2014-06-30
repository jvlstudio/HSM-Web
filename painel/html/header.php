<?php 
# ...
get_header("", "-empty"); ?>

<!-- LOADER -->
<?php 
get_html("loader"); ?>
<!-- MODAL -->
<?php 
get_modal(""); ?>

<!-- BODY CONTENT -->
<div id="body_content">
	<!-- SIDEBAR -->
	<ul id="sidebar">
		<?php 
		# ...
		get_menu(""); ?>
	</ul>
	<!-- CONTROLLER -->
	<div id="controller">
		<div class="topbar"></div>
		<div class="container">
			<!-- PAGE -->
			<div id="page">
			<div class="page_content">
			<div class="wrap">