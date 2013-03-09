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
$permissionsReq = 3;
include("includes/head.php");

/* ESSENTIAL BLOCK END */


$godid = $_COOKIE['gdnmsite_id'];
$godkey = $_COOKIE['gdnmsite_key'];

$checkLogin = mysql_query("SELECT * FROM administrators WHERE admin_id = $godid");

while($row = mysql_fetch_assoc($checkLogin))
{
	$admin_loginkey = unserialize($row['admin_loginkey']);
	$admin_permissions = $row['admin_permissions'];
}


$key = array_search($godkey, $admin_loginkey);
unset($admin_loginkey[$key]); # Remove the loginkey for this device from the database
$admin_loginkey = serialize($admin_loginkey);

mysql_query("UPDATE administrators SET admin_loginkey = '$admin_loginkey' WHERE admin_id = $godid");

setcookie("gdnmsite_id","", time()-864000000, '/'); # Set cookies to no value and in the past, browsers will auto delete them
setcookie("gdnmsite_key","", time()-864000000, '/');

?>
<body>

You have logged out

<a href="login">Log in</a>

</body>
</html>