<?php
include("../functions/config.php");

$admin_id = $_REQUEST['id'];
$success = 0;
$error = '';

$getAdmin = mysql_query("SELECT * FROM administrators WHERE admin_id = '$admin_id'");

while($row = mysql_fetch_assoc($getAdmin))
{
	$admin_id = $row['admin_id'];
	$admin_name = $row['admin_name'];
	$admin_email = $row['admin_email'];
	$admin_password = $row['admin_password'];
	$admin_permissions = $row['admin_permissions'];
	$admin_loginkey = $row['admin_loginkey'];
	$success = 1;
}

switch($admin_permissions)
{
	case "1":
		$content = '<input type="text" id="edit_admin_name" placeholder="Name" value="'.$admin_name.'">'.
'<input type="text" id="edit_admin_email" placeholder="Email" value="'.$admin_email.'">'.
'<input type="password" id="edit_admin_password" placeholder="Password" value="Unchanged">'.
'<select id="edit_admin_permissions">'.
	'<option value="1" selected>1 (Top level administrator)</option>'.
	'<option value="2">2 (Average backend user)</option>'.
	'<option value="3">3 (Average joe)</option>'.
'</select>'.
'<input class="button confirm" type="button" onClick="editAdministratorPost();" value="Edit administrator"/>';
		break;
	case "2":
		$content = '<input type="text" id="edit_admin_name" placeholder="Name" value="'.$admin_name.'">'.
'<input type="text" id="edit_admin_email" placeholder="Email" value="'.$admin_email.'">'.
'<input type="password" id="edit_admin_password" placeholder="Password" value="Unchanged">'.
'<select id="edit_admin_permissions">'.
	'<option value="1">1 (Top level administrator)</option>'.
	'<option value="2" selected>2 (Average backend user)</option>'.
	'<option value="3">3 (Average joe)</option>'.
'</select>'.
'<input class="button confirm" type="button" onClick="editAdministratorPost();" value="Edit administrator"/>';
		break;
	case "3":
		$content = '<input type="text" id="edit_admin_name" placeholder="Name" value="'.$admin_name.'">'.
'<input type="text" id="edit_admin_email" placeholder="Email" value="'.$admin_email.'">'.
'<input type="password" id="edit_admin_password" placeholder="Password" value="Unchanged">'.
'<select id="edit_admin_permissions">'.
	'<option value="1">1 (Top level administrator)</option>'.
	'<option value="2">2 (Average backend user)</option>'.
	'<option value="3" selected>3 (Average joe)</option>'.
'</select>'.
'<input class="button confirm" type="button" onClick="editAdministratorPost();" value="Edit administrator"/>';
		break;
}

echo json_encode(array("success"=>$success,"error"=>$error,"content"=>$content));

?>