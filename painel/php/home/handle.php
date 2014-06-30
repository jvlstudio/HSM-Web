<?php

@session_start();

# class..
$Tb 	= $Home;

# vars...
$id		= $_REQUEST['id'];
$scope	= $_REQUEST['scope'];
$now	= date("Y-m-d H:i:s");

# return..
if (!$scope)
	return;

# handle scope
switch ($scope):
	
	# ...
	case "edit":
	
		$models = array("events", "education", "videos", "magazines", "books");
		foreach($models as $model):
			
			$title 		= "{$model}_title";
			$img_ios	= "{$model}_image_ios";
			$img_android= "{$model}_image_android";
			
			# image ios..
			$prefix			= "{$img_ios}_";
			$sufix			= "@2x";
			$file_name 		= $_FILES[$img_ios];
			$max_width		= $_POST["{$img_ios}_width"];
			$max_height		= $_POST["{$img_ios}_height"];
			include("handle-uploads.php");
			$image_ios		= $image;
			
			# image android..
			$prefix			= "{$img_android}_";
			$sufix			= "@2x";
			$file_name 		= $_FILES["{$img_android}"];
			$max_width		= $_POST["{$img_android}_width"];
			$max_height		= $_POST["{$img_android}_height"];
			include("handle-uploads.php");
			$image_android	= $image;
		
			$Tb->update("1", "{$title}={$_POST[$title]}" );
			
			# update images..
			if (!empty($image_ios))
			{
				$el = $Tb->forId($id);
				if($el[$img_ios])
					@unlink("../uploads/".$el[$img_ios]);
				// ..
				$Tb->update($id, "{$img_ios}={$image_ios}");
			}
			if (!empty($image_android))
			{
				$el = $Tb->forId($id);
				if($el[$img_android])
					@unlink("../uploads/".$el[$img_android]);
				// ..
				$Tb->update($id, "{$img_android}={$image_android}");
			}
			
		endforeach;
		
		# return
		return_inside("/painel/{$args->dir}/thanks");
		break;
		
endswitch;

?>