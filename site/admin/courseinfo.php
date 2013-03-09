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

<h2>Past versions</h2>

<?php 

$getCourseInfo = mysql_query("SELECT * FROM courseInfo ORDER BY version_id DESC LIMIT 5");

if(mysql_num_rows($getCourseInfo)!=0)
{
	echo "<ul id='revertList'>";
	while($row = mysql_fetch_assoc($getCourseInfo))
	{
		$version_id = $row['version_id'];
		$version_user = $row['version_user'];
		$version_date = $row['version_date'];
		$version_clean_content = $row['version_clean_content'];
		$version_content = $row['version_content'];
		
		$getAdmin = mysql_query("SELECT * FROM administrators WHERE admin_id = $version_user");

		while($row = mysql_fetch_assoc($getAdmin))
		{
			$admin_id = $row['admin_id'];
			$admin_name = $row['admin_name'];
			$admin_email = $row['admin_email'];
			$admin_password = $row['admin_password'];
			$admin_permissions = $row['admin_permissions'];
			$admin_loginkey = $row['admin_loginkey'];
		}
		
		?>
		<li><a href="javascript:courseInfoRevert(<?php echo $version_id;?>);"><?php echo date("H:i:s jS F, Y",strtotime($version_date));?> - <?php echo $admin_name;?></a></li>
		<?php
	}
	echo "</ul>";
}

?>

<br><br>
<h2>Course info</h2>

<?php 

$getCourseInfo = mysql_query("SELECT * FROM courseInfo ORDER BY version_id DESC LIMIT 1");

while($row = mysql_fetch_assoc($getCourseInfo))
{
	$version_id = $row['version_id'];
	$version_user = $row['version_user'];
	$version_date = $row['version_date'];
	$version_clean_content = $row['version_clean_content'];
	$version_content = $row['version_content'];
}

?>

<!-- - - - - - 
	Hellz yeah I've got markdown on the go, you better believe it.
    
    At first I was afraid I was petrified
	Kept thinkin' I could never live with markdown by my side
- - - - - - -->

<textarea cols="40" rows="25" id="course_info"><?php echo $version_clean_content;?></textarea>
<br><br>
<input type="button" onClick="changeCourseInfo();" value="Change course info"/>

<div id="messageBox"></div>

</body>
</html>