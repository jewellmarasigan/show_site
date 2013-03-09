<?php
include("../functions/config.php");

$admin_id = $_REQUEST['id'];
$success = 0;
$error = '';

$delete = mysql_query("DELETE FROM administrators WHERE admin_id = $admin_id");

if($delete)
{
	$success = 1;
}
else
{
	$error = "Not sure whats gone on here, it didn't delete, maybe this will help: ".mysql_error();
}

echo json_encode(array("success"=>$success,"error"=>$error));

?>