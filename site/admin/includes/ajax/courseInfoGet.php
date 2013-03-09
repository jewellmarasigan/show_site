<?php
include("../functions/config.php");
include_once("../functions/markdown.php");

$id = $_REQUEST['id'];
$success = 0;
$error = '';

$getCourseInfo = mysql_query("SELECT * FROM courseInfo WHERE version_id = $id");

while($row = mysql_fetch_assoc($getCourseInfo))
{
	$version_id = $row['version_id'];
	$version_user = $row['version_user'];
	$version_date = $row['version_date'];
	$version_clean_content = $row['version_clean_content'];
	$version_content = $row['version_content'];
	$success = 1;
}

$error = mysql_error();

echo json_encode(array("success"=>$success,"error"=>$error,"content"=>$version_clean_content));

?>