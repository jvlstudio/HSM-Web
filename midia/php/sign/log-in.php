<?php

# ...
$user	= mysql_escape_string($_POST['ipt_user']);
$pass	= mysql_escape_string($_POST['ipt_pass']);

if ($Users->sign($user, $pass))
{
	$data	= (object) $Users->forKey($user, "slug");
	if($data->type == "administration")
	{
		@session_start();
		$_SESSION['user'] = $data;
		return_to(ROOT.'/midia/ads');
	}
	else {
		return_to(ROOT.'/midia/sign');
	}
}
else {
	return_to(ROOT.'/midia/sign');
}

?>