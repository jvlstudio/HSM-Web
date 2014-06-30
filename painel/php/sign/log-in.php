<?php

# ...
$user	= mysql_escape_string($_POST['ipt_user']);
$pass	= mysql_escape_string($_POST['ipt_pass']);

if ($AdmUsers->sign($user, $pass))
{
	@session_start();
	$data	= (object) $AdmUsers->forKey($user, "username");
	$_SESSION['user'] = $data;
	return_to(ROOT.'/painel/home');
}
else {
	return_to(ROOT.'/painel/sign');
}

?>