<?php
/* ESSENTIAL BLOCK START */

/*
	Login requirement is boolean true or false
	Permissions are:
		1 = Top level administrator
		2 = Average backend user
		3 = Average joe
*/

$loginReq = 1;
$permissionsReq = 2;
include("includes/head.php");

/* ESSENTIAL BLOCK END */

?>
<body>

<?php include("includes/design/header.php");?>

<h2>Administrators</h2>

<?php

$getAdministrators = mysql_query("SELECT * FROM administrators ORDER BY admin_name ASC");

if(mysql_num_rows($getAdministrators)!=0)
{
	echo "<ul>";
	while($row = mysql_fetch_assoc($getAdministrators))
	{
		$admin_id = $row['admin_id'];
		$admin_name = $row['admin_name'];
		$admin_email = $row['admin_email'];
		$admin_password = $row['admin_password'];
		$admin_permissions = $row['admin_permissions'];
		$admin_loginkey = $row['admin_loginkey'];
		
		?>
        <li id="administrator<?php echo $admin_id;?>">
            <h4><?php echo $admin_name;?></h4>
            <h5><?php echo $admin_email;?> | Permissions level: <?php echo $admin_permissions;?></h5>
            <a href="javascript:deleteAdministrator(<?php echo $admin_id;?>);">Delete</a>
        </li>
        <?php
	}
	echo "</ul>";
}

?>
<br><br>
<h2>Add administrator</h2>

<label for="admin_name">Name</label><br>
<input type="text" id="admin_name"/><br>
<label for="admin_email">Email</label><br>
<input type="text" id="admin_email"/><br>
<label for="admin_password">Password</label><br>
<input type="password" id="admin_password"/><br>
<label for="admin_permissions">Permissions</label><br>
<select id="admin_permissions">
	<option value="1">1 (Top level administrator)</option>
	<option value="2">2 (Average backend user)</option>	
	<option value="3">3 (Average joe)</option>
</select>
<br><br>
<input type="button" onClick="addAdministrator();" value="Add administrator"/>

<div id="messageBox"></div>

</body>
</html>