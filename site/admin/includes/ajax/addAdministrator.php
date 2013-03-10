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
		$checkEmail = mysql_query("SELECT * FROM administrators WHERE admin_email = '$admin_email'");
		
		if(mysql_num_rows($checkEmail)==0)
		{
			$admin_name = mysql_real_escape_string($admin_name);
			$admin_email = mysql_real_escape_string($admin_email);
			$admin_password = md5($admin_password);
			$admin_permissions = mysql_real_escape_string($admin_permissions);
			
			$success = mysql_query("INSERT INTO administrators VALUES('','$admin_name','$admin_email','$admin_password','$admin_permissions','a:0:{}')");
			
			if($success)
			{
				$success = 1;
			
				/*
				Function to send an email notifying people that theyve been made an administrator, just need a sender email firstly
				
				$name = 'GDNM';
				$sender = 'mail@gdnm.org';
				$to = $_REQUEST['email'];
				$subject = "Congratulations you are part of the GDNM show site team";
				$headers = "From: $name <$sender>\r\n";
				$headers .= "Content-type: text/html\r\n";
				
				$message = 'We wanted to email you and tell you that you have been called up to the big leagues<br><br>You have been added to the team on the GDNM Show site, and you can log in here: <a href="http://show.gdnm.org/admin/login">http://show.gdnm.org/admin/login</a>.<br><br>Your log in is:<br>'.$_REQUEST['email'].'<br>'.$_REQUEST['password'].'<br><br>We advise changing your password when you log in but yeah, looking forward to having you do...something to do with the site';
				
				$send = mail($to, $subject, $message, $headers);
				*/
			}
			else
			{
				$error = "Woah something went wrong and I don't know what, maybe this: ".mysql_error();
			}
		}
		else
		{
			$error = "Someone with that email already exists, just be yourself don't be anyone else";
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