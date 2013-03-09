<?php

$getAdmin = mysql_query("SELECT * FROM administrators WHERE admin_id = $godid");

while($row = mysql_fetch_assoc($getAdmin))
{
	$god_admin_id = $row['admin_id'];
	$god_admin_name = $row['admin_name'];
	$god_admin_email = $row['admin_email'];
	$god_admin_password = $row['admin_password'];
	$god_admin_permissions = $row['admin_permissions'];
	$god_admin_loginkey = $row['admin_loginkey'];
}

?>