<?php
include("../functions/config.php");
include_once("../functions/markdown.php");

date_default_timezone_set("GMT");
$course_clean_info = mysql_real_escape_string($_REQUEST['courseInfo']);
$course_info = mysql_real_escape_string(Markdown($_REQUEST['courseInfo']));
$godid = $_COOKIE['gdnmsite_id'];
$date = date("Y-m-d H:i:s");
$success = 0;
$error = '';
$content = '';

$getCourseInfo = mysql_query("SELECT * FROM courseInfo ORDER BY version_id DESC LIMIT 1");
            
if(mysql_num_rows($getCourseInfo)!=0)
{
	while($row = mysql_fetch_assoc($getCourseInfo))
	{
		$version_id = $row['version_id'];
		$version_user = $row['version_user'];
		$version_date = $row['version_date'];
		$version_clean_content = $row['version_clean_content'];
		$version_content = $row['version_content'];
	}
	
	if($_REQUEST['courseInfo']!=$version_clean_content)
	{

		$insert = mysql_query("INSERT INTO courseInfo VALUES('','$godid','$date','$course_clean_info','$course_info')");
		
		if($insert)
		{
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
			
			$success = 1;
			$dateset = date("H:i:s jS F, Y",strtotime($date));
			$content = '<li><a href="javascript:courseInfoRevert('.mysql_insert_id().');">'.$dateset.' - '.$god_admin_name.'</a></li>';
		}
		else
		{
			$error = "Unfortunately we couldn't change the course info, maybe its because of this: ".mysql_error();
		}
	}
	else
	{
		$error = "No changes were made";
	}
}
else
{
	$insert = mysql_query("INSERT INTO courseInfo VALUES('','$godid','$date','$course_clean_info','$course_info')");
	
	if($insert)
	{
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
		
		$success = 1;
		$dateset = date("H:i:s jS F, Y",strtotime($date));
		$content = '<li><a href="javascript:courseInfoRevert('.mysql_insert_id().');">'.$dateset.' - '.$god_admin_name.'</a></li>';
	}
	else
	{
		$error = "Unfortunately we couldn't change the course info, maybe its because of this: ".mysql_error();
	}
}

echo json_encode(array("success"=>$success,"error"=>$error,"content"=>$content));

?>