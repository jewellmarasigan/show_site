<?php
include("../functions/config.php");

$admin_name = $_REQUEST['name'];
$admin_email = $_REQUEST['email'];
$admin_password = $_REQUEST['password'];
$admin_permissions = $_REQUEST['permissions'];
$success = 0;
$error = '';

if($admin_name&&$admin_email&&$admin_password&&$admin_permissions)
{
	if(filter_var($admin_email, FILTER_VALIDATE_EMAIL))
	{
		$admin_name = mysql_real_escape_string($admin_name);
		$admin_email = mysql_real_escape_string($admin_email);
		$admin_password = mysql_real_escape_string($admin_password);
		$admin_permissions = mysql_real_escape_string($admin_permissions);
		
		$success = mysql_query("INSERT INTO administrators VALUES('','$admin_name','$admin_email','$admin_password','$admin_permissions','a:0:{}')");
		
		if($success)
		{
			$success = 1;
		}
		else
		{
			$error = "Woah something went wrong and I don't know what, maybe this: ".mysql_error();
		}
	}
	else
	{
		$error = "This does not look like an email to me";
	}
}
else
{
	$error = "Please fill out everything, thank you";
}

echo json_encode(array("success"=>$success,"error"=>$error));

?>