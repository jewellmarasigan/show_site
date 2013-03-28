<?php
include("../functions/config.php");

$admin_id = $_REQUEST['id'];
$admin_name = $_REQUEST['name'];
$admin_email = $_REQUEST['email'];
$admin_password = $_REQUEST['password'];
$admin_permissions = $_REQUEST['permissions'];
$success = 0;
$error = '';
$godid = $_COOKIE['gdnmsite_id'];

if($admin_name&&$admin_email&&$admin_password&&$admin_permissions)
{
	if(filter_var($admin_email, FILTER_VALIDATE_EMAIL))
	{
		
		$checkEmail = mysql_query("SELECT * FROM administrators WHERE admin_email = '$admin_email' AND admin_id != $admin_id");
		
		if(mysql_num_rows($checkEmail)==0)
		{
			if($admin_password!="Unchanged")
			{
				$admin_password = md5($admin_password);
				mysql_query("UPDATE administrators SET admin_password = '$admin_password' WHERE admin_id = $admin_id");
			}
			$admin_name = mysql_real_escape_string($admin_name);
			$admin_email = mysql_real_escape_string($admin_email);
			$admin_permissions = mysql_real_escape_string($admin_permissions);
			
			mysql_query("UPDATE administrators SET admin_name = '$admin_name' WHERE admin_id = $admin_id");
			mysql_query("UPDATE administrators SET admin_email = '$admin_email' WHERE admin_id = $admin_id");
			mysql_query("UPDATE administrators SET admin_permissions = '$admin_permissions' WHERE admin_id = $admin_id");
			
			if($godid==$admin_id)
			{
				$content = '<li id="administrator'.$admin_id.'">'.
					'<img src="images/icons/dark/user.png">'.
					'<h4>'.$_REQUEST['name'].'</h4>'.
					'<h5>'.$_REQUEST['email'].'</h5>'.
					'<span class="level level-'.$_REQUEST['permissions'].'"></span>'.
					'<span class="edit">'.
						'<a href="javascript:editAdministrator('.$admin_id.')" class="button">Edit</a>'.
					'</span>'.
				'</li>';
			}
			else
			{
				$content = '<li id="administrator'.$admin_id.'">'.
					'<img src="images/icons/dark/user.png">'.
					'<h4>'.$_REQUEST['name'].'</h4>'.
					'<h5>'.$_REQUEST['email'].'</h5>'.
					'<span class="level level-'.$_REQUEST['permissions'].'"></span>'.
					'<span class="edit">'.
						'<a href="javascript:editAdministrator('.$admin_id.')" class="button">Edit</a>'.
						'<a href="javascript:deleteAdministrator('.$admin_id.');" class="button">Delete</a>'.
					'</span>'.
				'</li>';
			}
			
			
			$success = 1;
			$error = mysql_error();
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

echo json_encode(array("success"=>$success,"error"=>$error,"content"=>$content));

?>