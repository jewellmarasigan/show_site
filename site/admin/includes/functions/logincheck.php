<?php

$godid = $_COOKIE['gdnmsite_id'];
$godkey = $_COOKIE['gdnmsite_key'];
$success = 0;

if($godid)
{
	$checkLogin = mysql_query("SELECT * FROM administrators WHERE admin_id = $godid");
	
	while($row = mysql_fetch_assoc($checkLogin))
	{
		$admin_loginkey = unserialize($row['admin_loginkey']);
		$admin_permissions = $row['admin_permissions'];
	}
	if(in_array($godkey,$admin_loginkey))
	{
		if($permissionsReq>=$admin_permissions)
		{
			$success = 1;
		}
		else
		{
			$success = 2;
		}
	}
}

if($success == 0)
{
	header("location:login");
}

if($success == 2)
{
	header("location:index?permissions=1");
}

?>