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

?>
<body>

Hello <?php echo $god_admin_name;?>,

<ul>
	<li><a href="../admin">Home</a></li>
	<li><a href="courseinfo">Course info</a></li>
	<li><a href="administrators">Administrators</a></li>
</ul>

</body>
</html>